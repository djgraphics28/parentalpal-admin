<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'routine_title',
        'time_of_day',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Define relationship to Child
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
