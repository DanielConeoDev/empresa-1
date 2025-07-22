<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    protected static function booted()
    {
        static::creating(function ($marca) {
            $marca->slug = Str::slug($marca->nombre);
        });
    }
}
