<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Child extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'gender',
    ];

   /**
    * Get the parent that owns the Child
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function parent(): BelongsTo
   {
       return $this->belongsTo(ParentPal::class, 'parent_id', 'id');
   }
}
