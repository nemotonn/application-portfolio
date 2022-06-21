<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'yearmonth',
        'calendardata_id',
        'user_id',

    ];



    public function schedules()
    {
      return $this->hasMany(Schedule::class);
    }

    public function calendardata()
    {
      return $this->belongsTo(Calendardata::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
