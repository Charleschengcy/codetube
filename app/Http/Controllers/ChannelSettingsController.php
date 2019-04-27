<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\channel;
use App\Http\Requests\ChannelUpdateRequest;

use App\Jobs\Uploadimage;

class ChannelSettingsController extends Controller
{
    public function edit(channel $channel)
    {
        $this->authorize('edit',$channel);

        return view('channel.settings.edit', [
            'channel' => $channel,
        ]);
    }

    public function update(ChannelUpdateRequest $request, channel $channel)
    {
        $this->authorize('update',$channel);

        $channel->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        //检查是否有图片文件
        if($request->file('image')){
            //将图片文件移动到临时文件夹并制定id
            $request->file('image')->move(storage_path().'/uploads', $fileId = uniqid(true));

            //调用job
            $this->dispatch(new Uploadimage($channel, $fileId));
        }

        return redirect()->Route('channel.edit', $channel)->with('success', 'Updated successfully!');
    }
}
