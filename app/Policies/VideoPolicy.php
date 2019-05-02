<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    //
    public function update(User $user, Video $video)
    {
        //当前登录用户id等于修改对象的用户id的时候
        return $user->id === $video->channel->user_id;
    }
}
