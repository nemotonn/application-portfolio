<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//フォームモデルアクセサ　定義
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;


class Calendardata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'placename',
        'numOfCycles',
        'cycle',
        'quickcycle',
        'startday',
        'endday',

    ];


    public function user()
    {
      return $this->belongsTo(User::class);
    }

    //scheduleの主
    public function schedules()
    {
      return $this->hasMany(Schedule::class);
    }

    public function percentages()
    {
      return $this->hasMany(Percentage::class);
    }



    // editフォームでdate取得する場合にモデル取得する前に
    //ここでcarbonでパースすることでフォームに自動的に挿入してくれるよ
    use FormAccessible;

    public function getStartdayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getEnddayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }


    
}
