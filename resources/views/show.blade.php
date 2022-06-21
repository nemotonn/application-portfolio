
@extends('layouts.frame')
@section('content')

<div class="common-container">
  <div class="show-box">
    <div class="show-info-box">
      <h2>{{ $oneDay }}</h2>
      <p>
        本日のお掃除予定が完了したらチェックしましょう！
      </p>
    </div>

    @if($userSchedules->isEmpty())
    <div class="no-data-box">
      <p>
        予定はありません
      </p>
    </div>
    @endif

    @if($userSchedules->isNotEmpty())
    <div class="show-tabele-box">
      <table class="show-table">

        @foreach($userSchedules as $userSchedule)
        <tr>
          <td>
            {{ $userSchedule->calendardata->placename }}
          </td>
          <td>
            <div class="show-button-box">
              @if($userSchedule->is_done == null)

              <a href="{{ route('calendardatas.percentageupdate', ['scheduleId'=> $userSchedule->id, 'done' => '1']) }}"
                  class="show-active-button">完了</a>

              @elseif($userSchedule->is_done == true)

              <a class="show-done-button">完了済み</a>


              @endif
            </div>

          </td>
        </tr>
        @endforeach

      </table>
    </div>
    @endif

  </div>
</div>

@endsection
