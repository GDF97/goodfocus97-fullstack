<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Picture extends Model
{
    protected $fillable = [
        'path',
        'title',
        'desc',
        'camera_id',
        'user_id',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function camera(): BelongsTo
    {
        return $this->belongsTo(Camera::class);
    }

   public function categories(): BelongsToMany
   {
        return $this->belongsToMany(
        Category::class,
        'picture_category',
        'picture_id',
        'category_id'
        );
   }
}
