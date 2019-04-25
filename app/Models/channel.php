<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_filename';
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
