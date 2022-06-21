<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
//使用モデル定義
use App\Models\User;
use App\Models\Calendardata;
use App\Models\Schedule;
use App\Models\Percentage;

use Illuminate\Support\Facades\Auth; //auth使うよう定義
use Illuminate\Support\Facades\Validator; //バリデータ使うよう定義

use App\Http\Requests\StorePostRequest; //バリデフォームリクエスト ファイル使う指定
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB; //クエリビルダ
use Illuminate\Support\Collection; //コレクション
use Illuminate\Support\Str; //strファサードヘルパ

use Functions; //自作クラス使うやつ Functions::メソッド()で呼び出し


class CalendardataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $user;

     public function __construct()
     {

       $this->middleware('auth');
       $this->middleware(function ($request, $next) {

            $this->user = \Auth::user();
            return $next($request);
        });


     }


     public function index(int $year = null,int $month = null)
     {

       //*[カレンダー表示]-----------------------------------------------
       $weeks = ['日','月', '火','水',
       '木','金','土'];
       $today = Carbon::today();

       Carbon::setWeekStartsAt(Carbon::SUNDAY); // 週の最初を日曜日に設定
       Carbon::setWeekEndsAt(Carbon::SATURDAY); // 週の最後を土曜日に設定

       $dt = new Carbon();
       $dt->locale('ja_JP');
       $dt = Carbon::createMidnightDate($year, $month, 1);  //時間を0:00に設定のクリエイト

       $firstofmonth = $dt->copy()->firstOfMonth(); //今月のスタート日格納
       $lastofmonth = $dt->copy()->lastOfMonth(); //今月の終わり日
       $firstday = $firstofmonth->copy()->startOfWeek(); //今月のスタート週
       $endday = $lastofmonth->copy()->endOfWeek(); //今月の終わり週
       $endday->setTime(0,0);

       //今月のdateをdate[]に格納
       $dates = [];
       while ($firstday <= $endday) {
           $dates[] = $firstday->copy();
           $firstday->addDay();
       }
       //---------------------------------------------------------


       //[カレンダーにスケジュールを表示]----------------------------------


       $id = $this->user->id; //コンストラクタauth使用
       $schedules = User::find($id)->schedules;

       $check = $schedules->isNotEmpty(); //データが空じゃない場合true代入 判定

       //スケジュールがあれば配列に代入、なければnullを代入
       $scheduleDatas = [];
       if($check == true){
         $i = 0;
         foreach($schedules as $schedule){
           $scheduleDatas[$i]['date'] = $schedule->date;
           $scheduleDatas[$i]['placename'] = $schedule->calendardata->placename;
           //配列番号$i、配列内のkeyは名前で登録
           $i++; //スケジュール文内配列作りたいので配列番号UP
         }
       }else{
         $scheduleDatas = null;
       }
       //---------------------------------------------------------




       return view('index',compact('dt','weeks',
        'firstofmonth', 'dates', 'scheduleDatas', 'id', 'today'));

     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {


       //↓これ多分　違うやつだよね？ためし？
       // $userSchedules = User::find(7)->schedules;
       //
       // //判定するための新しい二次元配列作成
       // $scheduleArr_1 = [];
       // foreach($userSchedules as $userSchedule){
       //   $scheduleArr_1[] = [
       //        'date'=> date('Ym', strtotime($userSchedule->date)),
       //        'calendardata_id' => $userSchedule->calendardata_id,
       //        'placename' => $userSchedule->calendardata->placename,
       //   ];
       // }
       //
       //
       //
       // //percentagesに各年月のレコードあるか判定して、存在しなければ作成
       // foreach($scheduleArr_1 as $key => $value){
       //   if(Percentage::where('yearmonth', $value['date'])
       //    ->where('calendardata_id',$value['calendardata_id'])
       //    ->doesntExist()){ //存在しなければtrue
       //
       //       $percentage = new Percentage;
       //       $percentage->percentage = 0;
       //       $percentage->yearmonth = $value['date'];
       //       $percentage->calendardata_id = $value['calendardata_id'];
       //       //$percentage->user_id = $id;
       //       //$percentage->save();
       //   }
       // }
       //--------------------------------------------------------



       //percentage作成されたら スケジュールにpercentage_idふりわけ-------------------------
       // $scheduleArr_2 = [];
       // foreach ($userSchedules as $value) {
       //   if($value->percentage_id == null){  //スケジュールのpercentage_idがnullなら
       //     $scheduleArr_2[] = [
       //            'scheduleId' => $value->id,
       //            'calendardata_id' => $value->calendardata_id,
       //            'date'=> date('Ym', strtotime($value->date)),
       //     ];
       //   }
       // }
       //
       // foreach($scheduleArr_2 as $value){
       //   $match = Percentage::where('yearmonth', $value['date'])
       //    ->where('calendardata_id',$value['calendardata_id'])
       //    ->get();
       //
       //   $schedule = Schedule::find($value['scheduleId']);
       //   foreach($match as $value){
       //     $schedule->percentage_id = $value->id;
       //   }
       //   //$schedule->save();
       // }



         return view('create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(StorePostRequest $request) //元 Request $request 一旦避難StorePostRequest
     {

        $id = $this->user->id;
        $requestData = $request->all(); //加工後バリデ取得


        //もしweekが配列ならループ
        if(is_array($requestData['quickcycle'])){
          foreach($requestData['quickcycle'] as $week){
            $quickcycle = $week;

            $calendardata = new Calendardata;
            $calendardata->user_id = $id;

            Functions::calendardataSave($calendardata,$requestData,$quickcycle);
          }
        }else{
          $quickcycle = $requestData['quickcycle'];

          $calendardata = new Calendardata;
          $calendardata->user_id = $id;

          Functions::calendardataSave($calendardata,$requestData,$quickcycle);
        }

        Functions::scheduleCreate($id); //スケジュール作成
        Functions::percentageCreate($id);


        return redirect('/calendardatas/create')->with('status', '保存が完了しました！');

     }


     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($date)
     {

       $id = $this->user->id;
       $user = User::find($id);

       //スケジュールのdateカラムと$dateが一致するもののみ取得
       $userSchedules = $user->schedules()->where('date', $date)->get();
       $oneDay = Carbon::parse($date)->format('Y年m月d日');


       return view('show', compact('userSchedules', 'oneDay'));
     }


     public function percentagelist(int $year = null,int $month = null)
     {
       $id = $this->user->id;

       $dt = new Carbon();
       $dt->locale('ja_JP');
       $dt = Carbon::createMidnightDate($year, $month, 1);  //時間を0:00に設定のクリエイト
       $firstofmonth = $dt->copy()->firstOfMonth(); //今月のスタート日格納


       $YmDate = date('Ym', strtotime($dt)); //カーボンYm化
       $user = User::find($id);
       $percentages = $user->percentages()->where('yearmonth', $YmDate)->get(); //userIdから取得する
       $formatDate = Carbon::parse($dt)->format('Y年m月');




       return view('percentagelist', compact('percentages', 'firstofmonth', 'formatDate'));

     }



     public function percentageupdate($scheduleId, $done) //update
     {

       //スケジュール完了の更新------------------------
       $schedule = Schedule::find($scheduleId);
       $boolean = $schedule->is_done;
       if(empty($boolean)){ //もしdoneカラムがnull(未完了)なら保存
         $schedule->is_done = $done;
         $schedule->save();
       }

       //---------------------------------------------


       //パーセンテージ計算------------------------------
       function percentageCalc($totalSchedules, $doneSchedules){
         $x = $doneSchedules / $totalSchedules;
         $totalPercentage = floor($x * 100); //小数点切り捨て

         return $totalPercentage;
       }
       //---------------------------------------------



       //percentagesのpercentage％更新のためデータ取得---------------------------------
       $percentage = Schedule::find($scheduleId)->percentage;
       //完了した月とcalendardataのpercentageレコード取得
       $matchSchedules = Schedule::where('percentage_id', $percentage->id)->get();
       //スケジュールの中で取得したpercentageのidとマッチするスケジュールを全て取得

       $totalSchedules = $matchSchedules->count();  //スケジュールが何個あるか(100%)
       $doneSchedules = $matchSchedules->where('is_done', true)->count(); //スケジュール完了数

       $total = percentageCalc($totalSchedules, $doneSchedules); //計算の呼び出し
       $percentage->percentage = $total;
       $percentage->save();  //％更新
       //-----------------------------------------------------




       //完了押したら percentagelistへリダイレクト
       return redirect()->action(
         [CalendardataController::class, 'percentagelist']
       );

     }



     public function editlist()
     {
       $id = $this->user->id;
       $userCalendardatas = User::find($id)->calendardatas;

       //日本語へ変換
       $dateSet = [
         'every-year' => '毎年',
         'every-month' => '毎月',
         'every-monday' => '月曜日',
         'every-tuesday' => '火曜日',
         'every-wednesday' => '水曜日',
         'every-thursday' => '木曜日',
         'every-friday' => '金曜日',
         'every-saturday' => '土曜日',
         'every-sunday' => '日曜日',
         'week' => '週間',
         'month' => 'ヶ月',
         'day' => '日',

       ];

       foreach($userCalendardatas as $userCalendardata){
         foreach($dateSet as $key => $data){
           if($userCalendardata->quickcycle == $key){
             $userCalendardata->quickcycle = $data;
           }
           if($userCalendardata->cycle == $key){
             $userCalendardata->cycle = $data;
           }
         }
       }


       return view('editlist', compact('userCalendardatas'));

     }


     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($calendardata_id) //元 $id
     {

        $calendardata = Calendardata::find($calendardata_id);

        //echo $calendardata;

        return view('edit', compact('calendardata'));

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(UpdatePostRequest $request, $calendardata_id) //元 Request $request, $calendardata_id
     {

       $id = $this->user->id;
       $requestData = $request->all();



       //updete-----------------------------
       $quickcycle = $requestData['quickcycle'];

       $calendardata = Calendardata::find($calendardata_id);
       $calendardata->user_id = $id;
       Functions::calendardataSave($calendardata,$requestData,$quickcycle);
       //----------------------------------------------


       //updateできたら現在のcalendardataIDと連動しているschedules/percentage削除
       if($calendardata->wasChanged()){
         $nowSchedules = Calendardata::find($calendardata_id)->schedules;
         $nowPercentages = Calendardata::find($calendardata_id)->percentages;

         if($nowSchedules->isNotEmpty()){ //コレクションが空じゃなければ
           foreach($nowSchedules as $schedule){
             $schedule->delete();
           }
         }
         if($nowPercentages->isNotEmpty()){ //コレクションが空じゃなければ
           foreach($nowPercentages as $percentage){
             $percentage->delete();
           }
         }

         //updateされたデータで新しくスケジュール作成
         Functions::scheduleCreate($id);
         Functions::percentageCreate($id);
       }
       //------------------------------------------------------



       return redirect()->route('calendardatas.edit', ['calendardata_id'=> $calendardata_id])
        ->with('status', '変更が完了しました！');
       // return view('create');

     }


     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($calendardata_id) //元$id
     {
        $id = $this->user->id;

        $calendardata = Calendardata::find($calendardata_id); //現在のcalendardata
        $schedules = Calendardata::find($calendardata_id)->schedules; //現在のschedules
        $percentages = Calendardata::find($calendardata_id)->percentages;

        //取得したschedulesモデルのコレクションが存在していれば削除する
        if($schedules->isNotEmpty()){ //コレクションが空じゃなければ
          foreach($schedules as $schedule){
            $schedule->delete();
          }
        }
        if($percentages->isNotEmpty()){ //コレクションが空じゃなければ
          foreach($percentages as $percentage){
            $percentage->delete();
          }
        }
        $calendardata->delete();


        return redirect()->route('calendardatas.editlist', ['id' => $id]);
     }


 }
