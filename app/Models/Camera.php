<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Camera extends Model
{
     protected $fillable = [
        'name'
    ];
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }
}
