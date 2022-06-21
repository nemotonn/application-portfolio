index避難


<main>
  <div class="calendar-wapper">
    <div class="calendar-container">
      <div class="calendar-box">
        <p class="text-year">{{ $dt->year }}</p>
        <p class="text-month">{{ $dt->month }}月</p>
      </div>
      <div class="link-box">
        <div>
          <a href="{{ route('calendardatas.index', ['year'=> $firstofmonth->copy()->subMonth()->year,
            'month' => $firstofmonth->copy()->subMonth()->month ]) }}"><span class="allow-left-link"></span></a>
          <a href="{{ route('calendardatas.index') }}">当月</a>
          <a href="{{ route('calendardatas.index', ['year'=> $firstofmonth->copy()->addMonth()->year,
            'month' => $firstofmonth->copy()->addMonth()->month ]) }}"><span class="allow-right-link"></span></a>
        </div>
      </div>
    </div>

    <table>
      <tr>
        @foreach ($weeks as $week)
          <th>{{ $week }}</th>
        @endforeach
      </tr>

      <tr>
        @foreach($dates as $date)
          <!-- 先月来月のテキストカラー変更 -->

            <td @if($date->month != $dt->month) class="text-color" @endif id="info-link">
              <a href="{{ route('calendardatas.show',['date' => $date]) }}">

                <p class="text-day">{{ $date->day }}日</p>

                <!-- $scheduleDatasgがnullじゃなければ実行 -->
                @if(isset($scheduleDatas))
                <?php $i = 0; ?>

                  @foreach($scheduleDatas as $scheduleData)
                    <!-- 日付と一致しているtextを表示 -->
                    @if($date == $scheduleData['date'])
                    <!-- keyのdateを呼び出し -->
                      <?php $i++ ?>
                      @if($i <= 3)
                        <p class="text-sched">{{ $scheduleData['placename'] }}</p>
                      @endif
                    @endif
                  @endforeach

                  <!-- 3件以上で+表示 -->
                  @if($i >= 3)
                    <?php $plus = $i-3; ?>
                    <p class="text-plus">+{{ $plus }}</p>
                  @endif
                @endif

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

  <!-- <div class="calendar-info-wapper">
      <p>本日の掃除</p>

      <ul>
        <li>
          <dl>
            <dt>掃除場所</dt>
            <dd><a href="">完了</a></dd>
          </dl>

        </li>

      </ul>

    　
  </div>
   -->
</main>

@endsection
