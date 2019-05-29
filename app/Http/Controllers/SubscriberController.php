<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;
use App\UsersSubscribeData;
use Auth;

class SubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the channel subscribe resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, $id)
    {
        if (Auth::user()->id == Channel::select('userId')->where('id', $id)->first()->userId) {
            return redirect('/channel',)->withErrors('Failed to subscribing.');
        } else {
            // Add the data first
            $subscribeData = new UsersSubscribeData;
            $subscribeData->userId = Auth::user()->id;
            $subscribeData->channelId = $id;
            $subscribeData->save();

            // Update the subscriber count
            $channel = Channel::find($id);
            $channel->subscriber = $channel->subscriber + 1;
            $channel->save();
            return redirect('/channel');
        }
    }

    /**
     * Update the channel subscribe resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request, $id)
    {
        // Delete the data first
        $subscribeData = UsersSubscribeData::where([
            ['userId', Auth::user()->id],
            ['channelId', $id]
        ])->delete();

        $channel = Channel::find($id);
        $channel->subscriber = $channel->subscriber - 1;
        $channel->save();
        return redirect('/channel');
    }
}
