<?php

namespace App\Library;

use App\Models\User;
use App\Models\Calendardata;
use App\Models\Schedule;
use App\Models\Percentage;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB; //クエリビルダ
use Illuminate\Support\Collection; //コレクション


class Functions
{

    //calendardata保存メソ
    public static function calendardataSave($calendardata,$requestData,$quickcycle){

        $calendardata->placename = $requestData['placename'];
        $calendardata->numOfCycles = $requestData['numOfCycles'];
        $calendardata->cycle = $requestData['cycle'];
        $calendardata->quickcycle = $quickcycle;
        $calendardata->startday = $requestData['startday'];
        $calendardata->endday = $requestData['endday'];
        $calendardata->save();

    }


    //****************************************************************************:


    //スケジュール作成
    public static function scheduleCreate($id)
    {
      //スケジュールテーブルへ保存----------------------------------------
      function schedSave($key, $data, $id){

        $startDay = Carbon::create($data['startday']);
        $endDay = Carbon::create($data['endday']);
        $addCycle = $data['numOfCycles'];
        $calendarId = $data['id'];

        while ($startDay <= $endDay) {
          $saveDate = $startDay;

          //schedulesテーブルへ保存
          $schedule = new Schedule;
          $schedule->calendardata_id = $calendarId;
          $schedule->user_id = $id;
          $schedule->date = $saveDate;
          $schedule->percentage_id = null;
          $schedule->save();

          //詳細指定の増加
          if($key == 'day'){
            $startDay->addDays($addCycle);
          }
          if($key == 'week'){
            $startDay->addWeeks($addCycle);
          }
          if($key == 'month'){
            $startDay->addMonths($addCycle);
          }

          //クイックの増加
          if($key == 'every-month'){
            $startDay->addMonth();
          }
          if($key == 'every-year'){
            $startDay->addYear();
          }


        }
      }
      //--------------------------------------------------------

      //スケジュールテーブルへ保存 クイックweek編----------------------------
      function weekSchedSave($key,$data,$id){
        $startDay = Carbon::create($data['startday']);
        $endDay = Carbon::create($data['endday']);
        $calendarId = $data['id'];
        $weekData = $key; //受け取ったevery- ~


        $weekArr = [
          'every-sunday' => Carbon::SUNDAY,
          'every-monday' => Carbon::MONDAY,
          'every-tuesday' => Carbon::TUESDAY,
          'every-wednesday' => Carbon::WEDNESDAY,
          'every-thursday' => Carbon::THURSDAY,
          'every-friday' => Carbon::FRIDAY,
          'every-saturday' => Carbon::SATURDAY
        ];

        foreach($weekArr as $key => $value){
          if($key == $weekData){ //受け取った$keyとweek配列と同じデータのcarbon代入
            $week = $value;
          }
        }

        while ($startDay <= $endDay) {
          $saveDate = $startDay;

          if($saveDate->isDayOfWeek($week)){ //1日ずつaddして引っかかった曜日のみsave

            //schedulesテーブルへ保存
            $schedule = new Schedule;
            $schedule->calendardata_id = $calendarId;
            $schedule->user_id = $id;
            $schedule->date = $saveDate;
            $schedule->percentage_id = null;
            $schedule->save();


          }
          $startDay->addDay();
        }
      }
      //--------------------------------------------------------

      $calendardatas = User::find($id)->calendardatas;


      //詳細設定の場合　振り分け---------------------------------------------
      foreach($calendardatas as $calendardata){
          $detailDatas = $calendardata
           ->doesntHave('schedules')
           ->where('quickcycle', null)
           ->get();

      }
      $detailGroups = $detailDatas->groupBy('cycle');
      echo $detailGroups;

      //
      //
      if($detailGroups->isNotEmpty()){
        foreach ($detailGroups as $key => $values) {
          foreach($values as $value){
              $key = $key;
              $data = $value;
              schedSave($key,$data,$id);
          }
        }
      }
      //------------------------------------------------------------------



      //クイック取得　振り分け---------------------------------------------------
      foreach($calendardatas as $calendardata){
        $quickDatas = $calendardata
         ->doesntHave('schedules') //リレーション スケジュールテーブルがないもの
         ->whereNotNull('quickcycle')
         ->get();
      }
      $quickGroups = $quickDatas->groupBy('quickcycle');
      echo $quickGroups;


      if($quickGroups->isNotEmpty()){
        foreach ($quickGroups as $key => $values) {
          foreach($values as $value){
            if($key == 'every-month' || $key == 'every-year'){
              $key = $key;
              $data = $value;
              schedSave($key,$data,$id);
            }

            //クイックがweekの場合
            if($key != 'every-month' && $key != 'every-year'){
              $key = $key;
              $data = $value;
              weekSchedSave($key,$data,$id);
            }
          }
        }
      }

    }


    //****************************************************************************:


    //percentageレコード作成
    public static function percentageCreate($id)
    {
      //スケジュール作成されたらpercentageレコード作成-------------------
      $userSchedules = User::find($id)->schedules;

      //判定するための新しい二次元配列作成
      $scheduleArr_1 = [];
      foreach($userSchedules as $userSchedule){
        $scheduleArr_1[] = [
             'date'=> date('Ym', strtotime($userSchedule->date)),
             'calendardata_id' => $userSchedule->calendardata_id,
        ];
      }


      //percentagesに各年月のレコードあるか判定して、存在しなければ作成
      foreach($scheduleArr_1 as $key => $value){
        if(Percentage::where('yearmonth', $value['date'])
         ->where('calendardata_id',$value['calendardata_id'])
         ->doesntExist()){ //存在しなければtrue

            $percentage = new Percentage;
            $percentage->percentage = 0;
            $percentage->yearmonth = $value['date'];
            $percentage->calendardata_id = $value['calendardata_id'];
            $percentage->user_id = $id;
            $percentage->save();
        }
      }
      //--------------------------------------------------------



      //percentage作成されたら スケジュールにpercentage_idふりわけ-------------------------
      $scheduleArr_2 = [];
      foreach ($userSchedules as $value) {
        if($value->percentage_id == null){  //スケジュールのpercentage_idがnullなら
          $scheduleArr_2[] = [
                 'scheduleId' => $value->id,
                 'calendardata_id' => $value->calendardata_id,
                 'date'=> date('Ym', strtotime($value->date)),
          ];
        }
      }

      foreach($scheduleArr_2 as $value){
        $match = Percentage::where('yearmonth', $value['date'])
         ->where('calendardata_id',$value['calendardata_id'])
         ->get();

        $schedule = Schedule::find($value['scheduleId']);
        foreach($match as $value){
          $schedule->percentage_id = $value->id;
        }
        $schedule->save();
      }

    }



}
