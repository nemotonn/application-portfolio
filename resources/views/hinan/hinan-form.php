
<div class="form-container">
  <div class="form-box">

    <table class="form-table">
      <thead>
        <tr>
          <th colspan="2">
              お掃除場所・周期登録
          </th>
        </tr>
      </thead>
      <tr>
        <td colspan="2">
          <div class="flash-message-box">
            @if (session('status'))
              <div class="flash-message">
                <p>{{ session('status') }}</p>
              </div>
            @endif
          </div>
        </td>
      </tr>


      {{ Form::open(['route'=> 'calendardatas.store']) }}
        @csrf
      <tr>
        <!-- ★掃除場所 -->
        <td>{{ Form::label('placename', '掃除場所') }}</td>
        <td>
          {{ Form::text('placename', null, ['class' => 'text-form']) }}
          <!-- バリデエラー -->
          @if ($errors->has('placename'))
            <p class="bali-text">{{$errors->first('placename')}}</p>
          @endif
        </td>
      </tr>



      <!-- ★開始日 -->
      <tr>
        <td>{{ Form::label('startday', '開始日') }}</td>
        <td>{{ Form::date('startday', \Carbon\Carbon::now(), ['class' => 'text-form']) }}</td>
      </tr>

      <!-- ★終了日 -->
      <tr>
        <td><label for="enddaySelect">終了日</label></td>
        <td>

          <!-- JSで日付選択フォームだす -->
          <select id="enddaySelect" class="select-form">
            <option value="" selected>指定なし</option>
            <option value="">日付を指定</option>
          </select>

          <div class="create-form-toggle" id="enddayDateBox">
            {{ Form::date('endday', \Carbon\Carbon::now()->addYear(), ['class' => 'text-form']) }}
          </div>

          <!-- バリデ -->
          @if ($errors->has('endday'))
            <p class="bali-text">{{$errors->first('endday')}}</p>
          @endif

        </td>
      </tr>

      <!-- 周期クイックボタン  -->
      <tr>


        <td>{{ Form::label('cycle', '周期') }}</td>
        <td>
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

          <!-- 毎週クリックで表示 -->
          <div class="create-form-toggle week-list-box" id="cycleWeekBox">
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

          <!-- 詳細設定クリックで表示 -->
          <div class="create-form-toggle week-list-box" id="cycleDateBox">
            {{ Form::number('cycle[numOfCycles]', null,['class' => 'number-form']) }}
            {{ Form::select('cycle[cycle]', [''=>'選択', 'day'=>'日', 'week'=>'週間', 'month'=>'ヶ月'], '',['class' => 'select-form']) }}
              ごと繰り返し
          </div>

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

        </td>
      </tr>

      <tr>
        <td colspan="2" class="last-td">
          <div class="submit-content">
            <button type="submit" class="submit-button">設定する</button>
          </div>

        </td>
      </tr>



      {{ Form::close()}}

    </table>
  </div>
</div>
