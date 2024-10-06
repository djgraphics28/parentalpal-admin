<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function monthRanges()
    {
        return $this->belongsToMany(MonthRange::class, 'milestone_month_range');
    }
}
