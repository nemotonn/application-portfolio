<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendardata_id',
        'date',
        'user_id',
        'percentage_id',
        'is_done',

    ];



    public function calendardata()
    {
      return $this->belongsTo(Calendardata::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function percentage()
    {
      return $this->belongsTo(Percentage::class);
    }
}
