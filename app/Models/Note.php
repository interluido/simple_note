<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'note',
        'color_code',
        'image_path',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
