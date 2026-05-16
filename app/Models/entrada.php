<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrada extends Model
{
    use SoftDeletes;

    protected $fillable = ['mundo_id', 'titulo', 'categoria', 'contenido'];

    public function mundo()
    {
        return $this->belongsTo(Mundo::class);
    }
}
