<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personaje extends Model
{
    use SoftDeletes;

    protected $fillable = ['mundo_id', 'nombre', 'biografia', 'edad', 'genero', 'especie', 'apariencia_fisica', 'personalidad'];

    public function mundo()
    {
        return $this->belongsTo(Mundo::class);
    }

    
public function images() {
    return $this->hasMany(Image::class);
}
}
