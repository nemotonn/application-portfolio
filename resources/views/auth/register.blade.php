
@extends('layouts.frame')
@section('auth')

  <div class="auth-container">

    <div class="welcome-box">
      <h1>お掃除マスター!</h1>
      <p>お掃除専用スケジュールアプリ！</p>
    </div>


    <div class="auth-content-box">
      <div class="auth-box">
        <h2>sign up</h2>
        <ul>

          <form method="POST" action="{{ route('register') }}">
              @csrf

              <li><label for="name">ユーザー名</label></li>
              <li>
                <input id="name" type="text" class="auth-form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

									@error('name')
                    <p class="invalid-error">{{ $message }}</p>
                  @enderror
              </li>

              <li><label for="email">メールアドレス</label></li>
              <li>
                <input id="email" type="email" class="auth-form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                  @error('email')
                    <p class="invalid-error">{{ $message }}</p>
                  @enderror
              </li>

              <li><label for="password">パスワード</label></li>
              <li>
                <input id="password" type="password" class="auth-form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">

									@error('password')
                    <p class="invalid-error">{{ $message }}</p>
                  @enderror
              </li>

              <li><label for="password-confirm">確認パスワード</label></li>
              <li>
                <input id="password-confirm" type="password" class="auth-form-control"
                  name="password_confirmation" required autocomplete="new-password">
              </li>

              <li>
                <div class="auth-item-box">
                    <button type="submit" class="login-button">登録</button>
                </div>
              </li>

          </form>
        </ul>

      </div>
    </div>

  </div>
@endsection
