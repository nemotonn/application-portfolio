@extends('layouts.frame')
@section('content')

  <article class="com-wapper">
    <div class="com-container">
      <h2>タイトル</h2>
      <div class="edit-box">
        <!-- 保存完了レスポンス　フラッシュ -->
        @if (session('status'))
          <div>
            {{ session('status') }}
          </div>
        @endif


        {{ Form::model($calendardata, ['route'=> ['calendardatas.update', 'calendardata_id' => $calendardata->id]]) }}

        <dl class="create-dl-content">

          <dt>{{ Form::label('placename', '掃除場所') }}</dt>
          <dd>
            {{ Form::text('placename', null) }}

            <!-- バリデエラー -->
            @if ($errors->has('placename'))
              <p class="bali-text">{{$errors->first('placename')}}</p>
            @endif
          </dd>

          <!-- 開始日 -->
          <dt>{{ Form::label('startday', '開始日') }}</dt>
          <dd>{{ Form::date('startday', null) }}</dd>

          <!-- 終了日 -->
          <dt><label for="enddaySelect"></label></dt>
          <dd>
            <!-- 終了日を指定するかしないか、選択で -->
            <select id="enddaySelect">
              <option value="" selected>指定なし</option>
              <option value="">日付を指定</option>
            </select>

            <div>
              {{ Form::date('endday', null) }}

              <!-- バリデエラー -->
              @if ($errors->has('endday'))
                <p class="bali-text">{{$errors->first('endday')}}</p>
              @endif
            </div>
          </dd>
          <!-- ************************************************* -->


          <!-- 周期の指定 -->
          <dt>{{ Form::label('cycle', '周期') }}</dt>
          <dd class="create-dd-box">

            <div>
              <!-- 毎週か詳細設定にチェックはいってたら 非表示を表示にする -->

              <!-- 取得quickcycleカラムがどれかでradioチェック -->
              @php
                if($calendardata->quickcycle == 'every-month'){
                  $month = 'every-month';
                }elseif($calendardata->quickcycle == 'every-year'){
                  $year = 'every-year';
                }elseif(is_null($calendardata->quickcycle)){
                  $detail = null;
                }else{
                  $week = 'week';
                }
              @endphp


              <input type="radio" id="cycleWeekRadio" name="quickcycle[quick]" value="every-week" class="radio-button"
              <?php if(isset($week)){
                if(preg_match("/every-/",$calendardata->quickcycle)){echo 'checked';}} ?>>
              <label for="cycleWeekRadio" class="radio-text">毎週</label>

              <input type="radio" id="everyMonth" name="quickcycle[quick]" value="every-month" class="radio-button"
              <?php echo (isset($month) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="everyMonth" class="radio-text">毎月</label>

              <input type="radio" id="everyYear" name="quickcycle[quick]" value="every-year" class="radio-button"
              <?php echo (isset($year) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="everyYear" class="radio-text">毎年</label>

              <input type="radio" id="cycleDateRadio" name="quickcycle[quick]" value="detail-date" class="radio-button"
              <?php echo (isset($detail) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="cycleDateRadio" class="radio-text">詳細指定</label>

              <!-- バリデエラー -->
              @if ($errors->has('quickcycle.quick'))
                <p class="bali-text">{{$errors->first('quickcycle.quick')}}</p>
              @endif
            </div>


            <!-- quickcycleがweekだったらどの曜日かcheckboxチェック -->
            <!-- <dd class="create-dd-box"> -->
            @if(isset($week))
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
            @endif

            <div class="create-form-toggle create-dd-content" id="cycleWeekBox">
              <input type="checkbox" id="mon" name="quickcycle[week]" value="every-monday" class="check-button"
              <?php echo (isset($monday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="mon" class="check-text">月</label>

              <input type="checkbox" id="tue" name="quickcycle[week]" value="every-tuesday" class="check-button"
              <?php echo (isset($tuesday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="tue" class="check-text">火</label>

              <input type="checkbox" id="wed" name="quickcycle[week]" value="every-wednesday" class="check-button"
              <?php echo (isset($wednesday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="wed" class="check-text">水</label>

              <input type="checkbox" id="thur" name="quickcycle[week]" value="every-thursday" class="check-button"
              <?php echo (isset($thursday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="thur" class="check-text">木</label>

              <input type="checkbox" id="fri" name="quickcycle[week]" value="every-friday" class="check-button"
              <?php echo (isset($friday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="fri" class="check-text">金</label>

              <input type="checkbox" id="sat" name="quickcycle[week]" value="every-saturday" class="check-button"
              <?php echo (isset($saturday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="sat" class="check-text">土</label>

              <input type="checkbox" id="sun" name="quickcycle[week]" value="every-sunday" class="check-button"
              <?php echo (isset($sunday) == $calendardata->quickcycle)? 'checked':''; ?>>
              <label for="sun" class="check-text">日</label>

              <!-- バリデエラー -->
              @if ($errors->has('quickcycle.week'))
                <p class="bali-text">{{$errors->first('quickcycle.week')}}</p>
              @endif
            </div>

            <!-- 詳細設定クリックで表示 -->
            <div class="create-form-toggle create-dd-content" id="cycleDateBox">
              {{ Form::number('numOfCycles', null) }}
              {{ Form::select('cycle', [''=>'選択', 'day'=>'日', 'week'=>'週間', 'month'=>'ヶ月']) }}
              ごと繰り返し

              <!-- バリデエラー -->
              @if ($errors->has('numOfCycles'))
                <p class="bali-text">{{$errors->first('numOfCycles')}}</p>
              @endif
              @if ($errors->has('cycle'))
                <p class="bali-text">{{$errors->first('cycle')}}</p>
              @endif
            </div>


          </dd>
        </dl>

        <div class="edit-submit-content">
          <div>{{ Form::submit('設定する') }}</div>
        </div>


        {{ Form::close()}}

        <!-- <div class="edit-delete-content">
          {{ Form::open(['method' => 'delete', 'route' =>['calendardatas.destroy' ,'calendardata_id' => $calendardata->id] ]) }}
            <div>{{ Form::submit('削除',['id'=>'alert-demo']) }}</div>
          {{ Form::close() }}
        </div> -->

        <form method="POST" name="myform" action="{{ route('calendardatas.destroy', $calendardata->id) }}">
          @csrf
          <input name="_method" type="hidden" value="DELETE">
          <button type="submit" id="alert-demo">削除</button>
        </form>

    </div>
  </article>


@endsection
