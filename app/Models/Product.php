<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'price',
        'description', 
        'image',
    ];


        public function getPhotoUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }

        return null;
    }
}

