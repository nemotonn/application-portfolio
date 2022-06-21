

@extends('layouts.frame')
@section('auth')

  <div class="auth-container">



    <div class="welcome-box">
      <h1>お掃除マスター!</h1>
      <p>お掃除専用スケジュールアプリ！</p>
    </div>

    <div class="auth-content-box">
      <div class="auth-box">
        <h2>login</h2>
        <ul>

          <form method="POST" action="{{ route('login') }}">
              @csrf

              <li><label for="email">メールアドレス</label></li>
              <li>
                <input id="email" type="email" class="auth-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                  required autocomplete="email" autofocus>

                  @error('email')
                    <p class="invalid-error">{{ $message }}</p>
                  @enderror
              </li>

              <li>
                <label for="password" >パスワード</label>
              </li>
              <li>
                <input id="password" type="password" class="auth-form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="current-password">

                  @error('password')
                    <p class="invalid-error">{{ $message }}</p>
                  @enderror
              </li>

              <li>
                <div class="auth-item-box">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      情報を維持する
                    </label>
                </div>
              </li>



              <li>
                <div class="auth-item-box">
                  <button type="submit" class="login-button">ログイン</button>
                </div>

              </li>
							<li>
								<div class="auth-item-box">
									<a class="register-button" href="{{ route('register') }}">新しくはじめる</a>
                </div>
							</li>

          </form>
        </ul>

      </div>
    </div>

	</div>



@endsection
