@extends('layouts.frame')
@section('content')

<div class="calendar-container">

  <!-- カレンダーヘッダー -->
  <div class="calendar-header">
    <div class="c-header-text-box">
      <h2>{{ $dt->year }}年{{ $dt->month }}月</h2>
    </div>
    <a href="{{ route('calendardatas.index') }}">当月</a>
    <div class="c-header-link-box">
      <a href="{{ route('calendardatas.index', ['year'=> $firstofmonth->copy()->subMonth()->year,
        'month' => $firstofmonth->copy()->subMonth()->month ]) }}"><span class="arrow-left-link"></span></a>

      <a href="{{ route('calendardatas.index', ['year'=> $firstofmonth->copy()->addMonth()->year,
        'month' => $firstofmonth->copy()->addMonth()->month ]) }}"><span class="arrow-right-link"></span></a>
    </div>
  </div>

  <!-- カレンダーメイン -->
  <div class="calendar-content-box">
    <table class="calendar-table">
      <tr>
        @foreach ($weeks as $week)
          <th>{{ $week }}</th>
        @endforeach
      </tr>

      <tr>
        @foreach($dates as $date)
          <!-- 先月来月のカラー変更 -->
            <td <?php if($date->month != $dt->month) echo 'class="another-month-color"'; ?> id="info-link">


              <a href="{{ route('calendardatas.show',['date' => $date]) }}">
                <div class="calendar-td-box">
                  <div>
                    <span class="<?php if($today == $date) echo 'today-color'; ?>">
                      <p class="text-day">{{ $date->day }}</p>
                    </span>
                  </div>


                  <!-- $scheduleDatasgがnullじゃなければ実行 -->
                  @if(isset($scheduleDatas))
                  <?php $i = 0; ?>

                  <!-- <div class="sched-text-box"> -->
                    @foreach($scheduleDatas as $scheduleData)
                      <!-- 日付と一致しているtextを表示 -->
                      @if($date == $scheduleData['date'])
                      <!-- keyのdateを呼び出し -->
                        <?php $i++ ?>

                        @if($i <= 4)
                        <!-- 4件まで表示 -->
                        <p class="text-sched">{{Str::limit($scheduleData['placename'], 14)}}</p>


                        @endif
                      @endif
                    @endforeach

                    <!-- 3件以上で+表示 -->
                    @if($i > 4)
                      <?php $plus = $i-4; ?>
                      <div>
                        <p class="text-plus">+{{ $plus }}</p>
                      </div>
                    @endif


                  @endif

                </div>
              </a>
            </td>

          <!-- 土曜日にきたら改行 -->
          @if($date->isSaturday())
            <tr class="tr-line">
            </tr>
          @endif
        @endforeach
      </tr>
    </table>

  </div>
</div>

@endsection
