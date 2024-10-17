<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

   /**
    * Get all of the dailyRoutines for the Child
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function dailyRoutines(): HasMany
   {
       return $this->hasMany(DailyRoutine::class, 'child_id', 'id');
   }
}
