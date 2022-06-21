

@extends('layouts.frame')
@section('content')
  <div class="common-container">
    <div class="editlist-box">
      <h2>編集・削除</h2>

      @if($userCalendardatas->isEmpty())
      <div class="no-data-box">
        <p>
          データが登録されていません
        </p>
      </div>
      @endif


      @if($userCalendardatas->isNotEmpty())
      <div class="editlist-table-box">
        <table class="editlist-table">
          <thead>
            <tr>
              <th>場所</th>
              <th>周期</th>
              <th>
              </th>
            </tr>
          </thead>

          @foreach($userCalendardatas as $userCalendardata)

            <tr>
              <td>{{Str::limit($userCalendardata->placename, 20)}}</td>


              <td>
                @if($userCalendardata->quickcycle != '毎年' &&
                  $userCalendardata->quickcycle != '毎月' && $userCalendardata->quickcycle != null)
                  毎週
                @endif
                {{ $userCalendardata->quickcycle }}
                {{ $userCalendardata->numOfCycles }}
                {{ $userCalendardata->cycle }}

              </td>
              <td>
                <a href="{{ route('calendardatas.edit',['calendardata_id' => $userCalendardata->id]) }}" class="table-a">
                  <span class="arrow-right-link"></span>
                </a>
              </td>
            </tr>

          @endforeach
        </table>
      </div>
      @endif


    </div>


  </div>


@endsection
