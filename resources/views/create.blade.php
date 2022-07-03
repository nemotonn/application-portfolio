
@extends('layouts.frame')
@section('content')

<div class="common-container">
  <div class="form-container">


    <h2>場所・周期登録</h2>
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


          {{ Form::open(['route'=> 'calendardatas.store']) }}
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
            <li>{{ Form::date('startday', \Carbon\Carbon::now(), ['class' => 'text-form-control']) }}</li>


          <!-- ★終了日 -->

            <li><label for="enddaySelect">終了日</label></li>
            <li>

              <!-- JSで日付選択フォームだす -->
              <select id="enddaySelect" class="select-form-control">
                <option value="" selected>指定なし</option>
                <option value="">日付を指定</option>
              </select>
            </li>

            <li>
              <div class="form-toggle" id="enddayDateBox">
                {{ Form::date('endday', \Carbon\Carbon::now()->addYear(), ['class' => 'text-form-control']) }}
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
                <input type="radio" id="cycleWeekRadio" name="cycle[quick]" value="every-week" class="radio-button">
                <label for="cycleWeekRadio" class="radio-text">毎週</label>

                <input type="radio" id="everyMonth" name="cycle[quick]" value="every-month" class="radio-button">
                <label for="everyMonth" class="radio-text">毎月</label>

                <input type="radio" id="everyYear" name="cycle[quick]" value="every-year" class="radio-button">
                <label for="everyYear" class="radio-text">毎年</label>

                <input type="radio" id="cycleDateRadio" name="cycle[quick]" value="detail-date" class="radio-button">
                <label for="cycleDateRadio" class="radio-text">詳細指定</label>
              </div>
            </li>

              <!-- 毎週クリックで表示 -->
            <li>

              <div class="form-toggle week-list-box" id="cycleWeekBox">
                <input type="checkbox" id="mon" name="cycle[week][]" value="every-monday" class="check-button">
                <label for="mon" class="check-text">月</label>

                <input type="checkbox" id="tue" name="cycle[week][]" value="every-tuesday" class="check-button">
                <label for="tue" class="check-text">火</label>

                <input type="checkbox" id="wed" name="cycle[week][]" value="every-wednesday" class="check-button">
                <label for="wed" class="check-text">水</label>

                <input type="checkbox" id="thur" name="cycle[week][]" value="every-thursday" class="check-button">
                <label for="thur" class="check-text">木</label>

                <input type="checkbox" id="fri" name="cycle[week][]" value="every-friday" class="check-button">
                <label for="fri" class="check-text">金</label>

                <input type="checkbox" id="sat" name="cycle[week][]" value="every-saturday" class="check-button">
                <label for="sat" class="check-text">土</label>

                <input type="checkbox" id="sun" name="cycle[week][]" value="every-sunday" class="check-button">
                <label for="sun" class="check-text">日</label>
              </div>
            </li>
            <li>

              <!-- 詳細設定クリックで表示 -->
              <div class="form-toggle week-list-box" id="cycleDateBox">
                {{ Form::number('cycle[numOfCycles]', null,['class' => 'number-form-control']) }}
                {{ Form::select('cycle[cycle]', [''=>'選択', 'day'=>'日', 'week'=>'週間', 'month'=>'ヶ月'], '',['class' => 'select-form-control']) }}
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
              </div>

            </li>


          {{ Form::close()}}

        </ul>
      </div>
    </div>
  </div>
</div>



@endsection
