<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{

    public function update(VideoUpdateRequest $request, Video $video)
    {

        //验证video信息
        $this->authorize('update', $video);

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'allow_votes' => $request->has('allow_votes'),
            'allow_comments' => $request->has('allow_comments'),
        ]);


        if($request->ajax()){
            return response()->json(null, 200);
        }

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
            'video_filename' => "{$uid}.{$request->extension}",
        ]);

        return response()->json([
            'data' => [
                'uid' => $uid,
            ]
        ]);
    }
}
