<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\channel;
use App\Http\Requests\ChannelUpdateRequest;

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

        return redirect()->Route('channel.edit', $channel)->with('success', 'Updated successfully!');
    }
}
