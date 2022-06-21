@extends('layouts.frame')
@section('content')
<div class="top-wapper">
  <div class="top-title-container">
    <h2>ようこそ！</h2>
    <h1>お掃除スケジュアプリ</h1>
  </div>
  <div class="top-text-container">
    <p>このウェブアプリケーションはお掃除する期間を入力して</p>
    <p>カレンダーにスケジューリングしてくれるアプリです！</p>
    <p>スケジューリングした月単位でお掃除率も確認できますし</p>
    <p>前日に通知もしてくれます！</p>
    <p>簡単にはじめよう！</p>
  </div>
  <div class="top-link-container">
    <a href="{{ route('login') }}">ログイン</a>
    <a href="{{ route('register') }}">登録</a>
  </div>


</div>


@endsection
