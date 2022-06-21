@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






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

              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              <form method="POST" action="{{ route('password.email') }}">
                  @csrf

                  <li>
                    <label for="email">メールアドレス </label>
                  </li>
                  <li>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </li>
                  <li>
                    <div class="login-item-box">
                      <button type="submit" class="btn btn-primary">
                          リンクを送信
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
