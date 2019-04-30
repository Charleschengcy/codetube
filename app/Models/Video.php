<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    //引用trait
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'uid',
        'video_filename',
        'video_id',
        'processed',
        'visibility',
        'allow_votes',
        'allow_comments',
        'processed_percentage',
    ];

    public function channel()
    {
        //一个视频属于一个频道里的对应关系
        return $this->belongsTo(channel::class);
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }
}


