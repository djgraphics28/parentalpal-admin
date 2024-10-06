<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthRange extends Model
{
    use HasFactory;

     // Define which fields are mass assignable
     protected $fillable = [
        'month_range'
    ];

    public function milestones()
    {
        return $this->belongsToMany(Milestone::class, 'milestone_month_range');
    }
}
