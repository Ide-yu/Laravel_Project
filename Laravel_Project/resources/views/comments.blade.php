@extends('layout.layouts')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<main class="py-4">
  <div class="card" style="width:50%; margin: 0 auto; ">
  <head>
    <div class='text-center mt-2 mb-2 h5'>< コメント >
  </div>
  </head>
  <body>
    <div class="res_comment">
      @foreach($comments as $comment)
    <p>
      <label for="user-name">{{ $comment['name'] }} : </label>
      <label for="res_comment">{{ $comment['res_comment'] }}</label>
      <label for="created_at"><{{ $comment['created_at'] }}></label>
   </p>
   @endforeach
 </div>
 </body>
 </html>
 @endsection
