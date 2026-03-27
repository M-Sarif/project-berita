<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id_video';
    public $timestamps = false;

    protected $fillable = [
        'Judul', 'thumbnail', 'link_video', 'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];
}
