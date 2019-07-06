<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\jobs\UploadVideo;

class VideoUploadController extends Controller
{
    public function index()
    {
        return view('video.upload');
    }

    public function store(Request $request)
    {
        //获取用户的频道
        $channel = $request->user()->channel()->first();
        //查找video
        $video = $channel->videos()->where('uid', $request->uid)->firstOrFail();
        //移动到到临时位置
        $request->file('video')->move(storage_path() . '/uploads', $video->video_filename);
        // //上传到s3
        $this->dispatch(new UploadVideo(
            $video->video_filename
        ));

        return response()->json(null, 200);
    }

}

