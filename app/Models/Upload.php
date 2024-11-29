<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_path',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::url($this->upload);
    }
}
