
@php
  $name = Auth::user()->name;
@endphp


<nav class="header-nav">

  <div class="header-menu-box">
    <button type="button" class="hum-icon">
      <span class="hum-line-top"></span>
      <span class="hum-line-bottom"></span>
    </button>
    <h2>お掃除マスター!</h2>

  </div>

  <div class="header-user-box">
    <button type="button" class="user-icon">{{Str::limit($name, 4, '')}}</button>
  </div>

  <div class="logout-box">
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">ログアウト</a>
  </div>



  <!-- モバイル　ナビ -->
  <div class="mobile-nav">
    <div class="mobile-nav-box">
      <button type="button" class="nav-close-button">
        <span class="close-button-top"></span>
        <span class="close-button-bottom"></span>
      </button>
      <ul class="nav-list">
        <li><a href="{{ route('calendardatas.index') }}">ホーム</a></li>
        <li><a href="{{ route('calendardatas.create') }}">スケジュール登録</a></li>
        <li><a href="{{ route('calendardatas.editlist') }}">編集・削除</a></li>
        <li><a href="{{ route('calendardatas.percentagelist') }}">お掃除率</a></li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">ログアウト</a>
        </li>
      </ul>
    </div>
  </div>


  <!-- ログアウトフォーム　置き場 -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>


</nav>
