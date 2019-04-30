<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{

    public function update(Request $request, Video $video)
    {
        die('update');
    }

    public function store(Request $request)
    {
        //生成uid
        $uid = uniqid(true);

        //获取频道
        $channel = $request->user()->channel()->first();

        //写入保存视频信息
        $video = $channel->videos()->create([
            'uid' => $uid,
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'videio_filename' => "{$uid}.{$request->extension}",
        ]);

        return response()->json([
            'data' => [
                'uid' => $uid,
            ]
        ]);
    }
}
