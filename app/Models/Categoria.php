<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    protected static function booted()
    {
        static::creating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nombre);
        });
    }

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
}
