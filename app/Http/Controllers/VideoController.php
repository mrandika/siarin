<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;
use App\Upload;

use Auth;

class VideoController extends Controller
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

    public function index(Request $request)
    {
        
        return view('video/video_create');
    }

    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'video_name' => 'required|max:255',
            'video_file' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            'video_description' => 'required|max:1024',
        ]);

        $upload = new Upload;
        $video = $request->file('channelvideo_file_image');
        $filename = Auth::user()->id."-".str_random(10)."_channel-video";
        $extension = $image->getClientOriginalExtension();
        Storage::disk('public')->put($filename.'.'.$extension, File::get($image));
        $upload->uploadPath = $filename.'.'.$extension;
        $upload->title = $request->post('video_name');
        $upload->description = $request->post('video_description');
        $upload->channelId = Channel::select('id')->where('userId', Auth::user()->id)->first()->id;
        
        return redirect('/channel');
    }
}
