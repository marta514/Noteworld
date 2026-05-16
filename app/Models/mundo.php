<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mundo extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'titulo', 'descripcion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personajes() {
    return $this->hasMany(Personaje::class);
}
public function entradas() {
    return $this->hasMany(Entrada::class);
}

public function images() {
    return $this->hasMany(Image::class);
}
}
