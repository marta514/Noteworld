<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'url', 'ref_type', 'ref_id', 'estado', 'collection_id'];
    //ref = referencia (mundo o personaje)

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function reference()
{
    // Esto conectará automáticamente con Mundo o Personaje según el 'ref_type'
    return $this->morphTo(__FUNCTION__, 'ref_type', 'ref_id');
}
}
