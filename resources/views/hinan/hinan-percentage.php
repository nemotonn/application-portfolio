//パーセンテージ避難


<article class="com-wapper">
  <div class="com-container">
    <h2>タイトル</h2>
    <div class="percentage-info-box">
      <h2>{{ $formatDate }}</h2>
      <div class="percentage-link-box">
        <a href="{{ route('calendardatas.percentagelist', ['year'=> $firstofmonth->copy()->subMonth()->year,
          'month' => $firstofmonth->copy()->subMonth()->month ]) }}">前月</a>
        <a href="{{ route('calendardatas.percentagelist') }}">当月</a>
        <a href="{{ route('calendardatas.percentagelist', ['year'=> $firstofmonth->copy()->addMonth()->year,
          'month' => $firstofmonth->copy()->addMonth()->month ]) }}">次月</a>
      </div>
    </div>
    <div class="percentage-box">


      @if($percentages->isEmpty())
        <p>
          スケジュールが登録されていません
        </p>
      @endif

      <dl>
        @foreach($percentages as $percentage)
        <div class="percentage-content">
          <dt>
            {{ $percentage->calendardata->placename }}
          </dt>
          <dd>
            <div class="chart-outer">
              <div class="chart-inner" style="width:{{$percentage->percentage}}%;"></div>
            </div>
            <p>
              {{ $percentage->percentage }}%
            </p>
          </dd>
        </div>
        @endforeach
      </dl>


    </div>
  </div>
</article>


@endsection
