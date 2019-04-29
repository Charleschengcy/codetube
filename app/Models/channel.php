<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class channel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_filename',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        //一个频道可拥有多个视频的对应关系
        return $this->hasMany(Video::class);
    }
}
