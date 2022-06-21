//nav元　避難

<nav>
  <div class="header-wapper">
    <div class="hum-container">
      <div class="hum-icon" id="menu-icon">
          <span></span>
          <span></span>
          <span></span>
      </div>
    </div>
    <div class="user-container">
      <div class="user-icon" id="user-menuicon">

      </div>
    </div>
  </div>

  <!-- ハンバーガー ナビリスト -->
  <div class="nav-content">
    <ul class="nav-list">
      <li><a href="{{ route('calendardatas.index') }}">home</a></li>
      <li><a href="{{ route('calendardatas.create') }}">掃除場所の登録</a></li>
      <li><a href="{{ route('calendardatas.editlist') }}">掃除場所の編集</a></li>
      <li><a href="{{ route('calendardatas.percentagelist') }}">お掃除率</a></li>
      <li><a href="">使い方</a></li>
    </ul>
  </div>
  <div class="lognav-content">
    <ul class="lognav-list">
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">ログアウト</a></li>
      <li><a href="">ユーザー設定</a></li>
    </ul>
  </div>

  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>


</nav>
