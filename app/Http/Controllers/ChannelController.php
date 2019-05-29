<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;

use Auth;
use Storage;
use File;

class ChannelController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Channel::all();
        return view('channel/channel_list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('channel/channel_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'channel_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'channel_name' => 'required|max:255',
            'channel_description' => 'max:1024',
        ]);

        $name = $request->post('channel_name');
        $description = $request->post('channel_description');
        $hasImage = $request->hasFile('channel_image');

        $channel = new Channel;

        if($hasImage){
            $image = $request->file('channel_image');
            $filename = Auth::user()->id."-".str_random(10)."_channel-image";
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put($filename.'.'.$extension, File::get($image));

            $channel->imagePath = $filename.'.'.$extension;
        }

        $channel->name = $name;
        $channel->description = $description;
        $channel->userId = Auth::user()->id;
        $channel->save();
        return redirect('/channel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $channel = Channel::find($id);
        return view('channel/channel_show', compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $channel = Channel::find($id);
        return view('channel/channel_update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return redirect('/channel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $channel = Channel::find($id);
        $channel->delete();
        return redirect('/channel');
    }
}
