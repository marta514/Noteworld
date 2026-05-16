<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre', 'descripcion'];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
