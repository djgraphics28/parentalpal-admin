<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child extends Model
{
    use HasFactory;


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
