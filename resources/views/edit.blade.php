
@extends('layouts.frame')
@section('content')

<div class="common-container">
  <div class="form-container">

    <h2>編集・削除</h2>
    <div class="form-outer-box">

      <div class="form-box">
      <ul>


        <li>
          <div class="flash-message-box">
            @if (session('status'))
              <div class="flash-message">
                <p>{{ session('status') }}</p>
              </div>
            @endif
          </div>
        </li>


      {{ Form::model($calendardata, ['route'=> ['calendardatas.update', 'calendardata_id' => $calendardata->id]]) }}
        @csrf

        <!-- ★掃除場所 -->
        <li>{{ Form::label('placename', '掃除場所') }}</li>
        <li>
          {{ Form::text('placename', null, ['class' => 'text-form-control']) }}
          <!-- バリデエラー -->
          @if ($errors->has('placename'))
            <p class="bali-text">{{$errors->first('placename')}}</p>
          @endif
        </li>



      <!-- ★開始日 -->

        <li>{{ Form::label('startday', '開始日') }}</li>
        <li>{{ Form::date('startday', null, ['class' => 'text-form-control']) }}</li>



      <!-- ★終了日 -->

        <li><label for="enddaySelect">終了日</label></li>
        <li>

        <li>
          <!-- JSで日付選択フォームだす -->
          <select id="enddaySelect" class="select-form-control">
            <option value="" selected>指定なし</option>
            <option value="">日付を指定</option>
          </select>
        </li>

        <li>
          <div class="form-toggle" id="enddayDateBox">
            {{ Form::date('endday', null, ['class' => 'text-form-control']) }}
          </div>
        </li>

        <li>
          <!-- バリデ -->
          @if ($errors->has('endday'))
            <p class="bali-text">{{$errors->first('endday')}}</p>
          @endif
        </li>


      <!-- 周期クイックボタン  -->


        <li>{{ Form::label('cycle', '周期') }}</li>
        <li>
          <div class="quick-list-box">
            <!-- 取得quickcycleカラムがどれかでradioチェック -->
            @php
              if($calendardata->quickcycle == 'every-month'){
                $month = 'every-month';

              }elseif($calendardata->quickcycle == 'every-year'){
                $year = 'every-year';
              }elseif(is_null($calendardata->quickcycle)){
                $detail = 'detail';

              }else{
                $weeks = 'weeks';
              }
            @endphp

            <input type="radio" id="cycleWeekRadio" name="quickcycle[quick]" value="every-week" class="radio-button"
            <?php if(isset($weeks)){
              if(preg_match("/every-/",$calendardata->quickcycle)){echo 'checked';}} ?>>
            <label for="cycleWeekRadio" class="radio-text">毎週</label>

            <input type="radio" id="everyMonth" name="quickcycle[quick]" value="every-month" class="radio-button"
            <?php echo (isset($month) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="everyMonth" class="radio-text">毎月</label>

            <input type="radio" id="everyYear" name="quickcycle[quick]" value="every-year" class="radio-button"
            <?php echo (isset($year) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="everyYear" class="radio-text">毎年</label>

            <input type="radio" id="cycleDateRadio" name="quickcycle[quick]" value="detail-date" class="radio-button"
            <?php echo (isset($detail))? 'checked':''; ?>>
            <label for="cycleDateRadio" class="radio-text">詳細指定</label>


          </div>
        </li>

        <li>
          <!-- 毎週クリックで表示 -->
          <div class="form-toggle week-list-box" id="cycleWeekBox">
            <!-- quickcycleがweekだったらどの曜日かcheckboxチェック -->
            @php
              if($calendardata->quickcycle == 'every-monday'){
                $monday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle == 'every-tuesday'){
                $tuesday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle  == 'every-wednesday'){
                $wednesday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle  == 'every-thursday'){
                $thursday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle  == 'every-friday'){
                $friday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle  == 'every-saturday'){
                $saturday = $calendardata->quickcycle;
              }elseif($calendardata->quickcycle  == 'every-sunday'){
                $sunday = $calendardata->quickcycle;
              }

            @endphp


            <input type="checkbox" id="mon" name="quickcycle[week]" value="every-monday" class="check-button"
            <?php echo (isset($weeks) && isset($monday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="mon" class="check-text">月</label>

            <input type="checkbox" id="tue" name="quickcycle[week]" value="every-tuesday" class="check-button"
            <?php echo (isset($weeks) && isset($tuesday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="tue" class="check-text">火</label>

            <input type="checkbox" id="wed" name="quickcycle[week]" value="every-wednesday" class="check-button"
            <?php echo (isset($weeks) && isset($wednesday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="wed" class="check-text">水</label>

            <input type="checkbox" id="thur" name="quickcycle[week]" value="every-thursday" class="check-button"
            <?php echo (isset($weeks) && isset($thursday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="thur" class="check-text">木</label>

            <input type="checkbox" id="fri" name="quickcycle[week]" value="every-friday" class="check-button"
            <?php echo (isset($weeks) && isset($friday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="fri" class="check-text">金</label>

            <input type="checkbox" id="sat" name="quickcycle[week]" value="every-saturday" class="check-button"
            <?php echo (isset($weeks) && isset($saturday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="sat" class="check-text">土</label>

            <input type="checkbox" id="sun" name="quickcycle[week]" value="every-sunday" class="check-button"
            <?php echo (isset($weeks) && isset($sunday) == $calendardata->quickcycle)? 'checked':''; ?>>
            <label for="sun" class="check-text">日</label>


          </div>
        </li>

        <li>
          <!-- 詳細設定クリックで表示 -->
          <div class="form-toggle week-list-box" id="cycleDateBox">
            {{ Form::number('numOfCycles', null,['class' => 'number-form-control']) }}
            {{ Form::select('cycle', [''=>'選択', 'day'=>'日', 'week'=>'週間', 'month'=>'ヶ月'], null,['class' => 'select-form-control']) }}
              ごと繰り返し
          </div>
        </li>

        <li>
          <!-- バリデエラー -->
          @if ($errors->has('cycle.quick'))
            <p class="bali-text">{{$errors->first('cycle.quick')}}</p>
          @endif

          <!-- バリデ -->
          @if ($errors->has('cycle.week'))
            <p class="bali-text">{{$errors->first('cycle.week')}}</p>
          @endif

          <!-- バリデエラー -->
          @if ($errors->has('cycle.numOfCycles'))
            <p class="bali-text">{{$errors->first('cycle.numOfCycles')}}</p>
          @endif
          @if ($errors->has('cycle.cycle'))
            <p class="bali-text">{{$errors->first('cycle.cycle')}}</p>
          @endif

        </li>



        <li>
          <div class="form-submit-box">
            <button type="submit" class="submit-button">設定する</button>
        {{ Form::close()}}


            <form method="POST" name="myform" action="{{ route('calendardatas.destroy', $calendardata->id) }}">
              @csrf
              <input name="_method" type="hidden" value="DELETE">
              <button type="submit" id="alert-demo" class="delete-button">削除</button>
            </form>
          </div>
        </li>

      </ul>
    </div>
  </div>
</div>



@endsection
