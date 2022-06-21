<div class="create-box">



  {{ Form::open(['route'=> 'calendardatas.store']) }}
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
    <dd>{{ Form::date('startday', \Carbon\Carbon::now()) }}</dd>

    <!-- ************************************************* -->

    <!-- 終了日input/ -->
    <dt><label for="enddaySelect"></label></dt>
    <dd>
      <!-- 終了日を指定するかしないか、選択で -->
      <select id="enddaySelect">
        <option value="" selected>指定なし</option>
        <option value="">日付を指定</option>
      </select>

      <!-- 日付を指定でこのフォームだす -->
      <div class="create-form-toggle" id="enddayDateBox">
        {{ Form::date('endday', \Carbon\Carbon::now()->addYear()) }}
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
        <input type="radio" id="cycleWeekRadio" name="cycle[quick]" value="every-week" class="radio-button">
        <label for="cycleWeekRadio" class="radio-text">毎週</label>

        <input type="radio" id="everyMonth" name="cycle[quick]" value="every-month" class="radio-button">
        <label for="everyMonth" class="radio-text">毎月</label>

        <input type="radio" id="everyYear" name="cycle[quick]" value="every-year" class="radio-button">
        <label for="everyYear" class="radio-text">毎年</label>

        <input type="radio" id="cycleDateRadio" name="cycle[quick]" value="detail-date" class="radio-button">
        <label for="cycleDateRadio" class="radio-text">詳細指定</label>

        <!-- バリデエラー -->
        @if ($errors->has('cycle.quick'))
          <p class="bali-text">{{$errors->first('cycle.quick')}}</p>
        @endif


      </div>


      <!-- 毎週クリックで表示 -->
      <!-- <dd class="create-dd-box"> -->
      <div class="create-form-toggle create-dd-content" id="cycleWeekBox">
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

        <!-- バリデエラー -->
        @if ($errors->has('cycle.week'))
          <p class="bali-text">{{$errors->first('cycle.week')}}</p>
        @endif
      </div>


      <!-- 詳細設定クリックで表示 -->
      <div class="create-form-toggle create-dd-content" id="cycleDateBox">
        {{ Form::number('cycle[numOfCycles]', null) }}
        {{ Form::select('cycle[cycle]', [''=>'選択', 'day'=>'日', 'week'=>'週間', 'month'=>'ヶ月'], '',) }}
        <!-- 同じname属性で配列で受け取るためcycle[] -->
        ごと繰り返し

        <!-- バリデエラー -->
        @if ($errors->has('cycle.numOfCycles'))
          <p class="bali-text">{{$errors->first('cycle.numOfCycles')}}</p>
        @endif
        @if ($errors->has('cycle.cycle'))
          <p class="bali-text">{{$errors->first('cycle.cycle')}}</p>
        @endif

      </div>



    </dd>
  </dl>


  <div class="create-submit-content">
    <div>{{ Form::submit('設定する') }}</div>
  </div>


  {{ Form::close()}}

</div>
</div>
</article>


@endsection
