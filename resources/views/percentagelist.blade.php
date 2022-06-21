
@extends('layouts.frame')
@section('content')

<div class="common-container">
  <div class="percentage-box">
    <h2>お掃除率</h2>
    <div class="percentage-info-box">

      <div>
        <a href="{{ route('calendardatas.percentagelist', ['year'=> $firstofmonth->copy()->subMonth()->year,
          'month' => $firstofmonth->copy()->subMonth()->month ]) }}">
          <span class="arrow-left-link"></span>
        </a>
        <p class="percentage-info-text">{{ $formatDate }}</p>
        <a href="{{ route('calendardatas.percentagelist', ['year'=> $firstofmonth->copy()->addMonth()->year,
          'month' => $firstofmonth->copy()->addMonth()->month ]) }}">
          <span class="arrow-right-link"></span>
        </a>
      </div>

    </div>

    @if($percentages->isEmpty())
      <div class="no-data-box">
        <p>
          スケジュールが登録されていません
        </p>
      </div>
    @endif


    @if($percentages->isNotEmpty())
      <div class="percentage-table-box">
        <table class="percentage-table">
          <thead>
            <tr>
              <th>場所</th>
              <th>割合</th>
            </tr>
          </thead>

          @foreach($percentages as $percentage)
          <tr>

            <td class="chart-td">
              <div class="chart-box">
                <p>{{Str::limit($percentage->calendardata->placename, 20)}}</p>
                <div class="chart-outer">
                  <div class="chart-inner" style="width:{{$percentage->percentage}}%;"></div>
                </div>
              </div>

            <td>
              <p>{{ $percentage->percentage }}%</p>
            </td>

          </tr>
          @endforeach
        </table>

      </div>
    @endif

  </div>
</div>

@endsection
