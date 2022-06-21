<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>掃除管理</title>
		<!-- <link rel="stylesheet"　type="text/css" href="/css/style.css"> -->
		<link href="{{ asset('css/auth.css') }}" rel="stylesheet">

		<!-- <script src="{{ asset('js/hum.js') }}" defer></script> -->
		<script src="{{ asset('js/formtoggle.js') }}" defer></script>
		<script src="{{ asset('js/alert.js') }}" defer></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	</head>
	<body>
    <div class="wrapper">
      <div class="login-container">
        <div class="login-box">
          <h2>パスワードリセット</h2>
          <ul>


            <form method="POST" action="{{ route('password.update') }}">
                @csrf

              <input type="hidden" name="token" value="{{ $token }}">


              <li>
                <label for="email">メールアドレス</label>
              </li>
              <li>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </li>

              <li>
                <label for="password">パスワード</label>
              </li>
              <li>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </li>

              <li>
                <label for="password-confirm">パスワード確認</label>
              </li>
              <li>
                <input id="password-confirm" type="password" class="form-control"
                  name="password_confirmation" required autocomplete="new-password">
              </li>


              <li>
                <div class="login-item-box">
                  <button type="submit">
                      パスワードリセット
                  </button>

                </div>
              </li>
            </form>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>
