@extends('layout.layouts')
@section('content')
<html lang="ja">
<main class="py-4">
<head>
  <div class="card-header">
    <div class='text-center'>お気に入り一覧</div>
  </div>
<div style="width:50%; margin: 0 auto; ">
  </head>
<div class="card">
  <body>
<table class='table'>
@foreach($posts as $post)
  <label for='name'>ユーザー名 : {{ $post['name'] }}</label>
  <label for='comment'>コメント : {{ $post['comment'] }}</label>
  <label for='area'>エリア : {{ $post['area_name'] }}</label>
  <label for='area'>photo : <img src="{{ asset('storage/' .$post['image_path']) }}" width="100%" height="100%"></label>
  <label for='date'>日付 : {{ $post['date'] }}</label>
  <!-- @if(is_null($post['post_id']))
  <label>お気に入り : 登録未済</label>
　@else
  <label>お気に入り : 登録済</label>
  @endif -->
  </div>
  <span class="border-top border-line"></span>
@endforeach
</table>
</body>
</html>
</div>
</div>
</div>
@endsection
