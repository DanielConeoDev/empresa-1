<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'nombre', 'slug'];

    protected static function booted()
    {
        static::creating(function ($subcategoria) {
            $subcategoria->slug = Str::slug($subcategoria->nombre);
        });
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
