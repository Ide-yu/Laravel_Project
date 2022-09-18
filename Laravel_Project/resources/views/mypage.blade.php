@extends('layout.layouts')
@section('content')
<html lang="ja">
<main class="py-4">
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<div style="width:50%; margin: 0 auto; ">
<div class='col-12 clearfix'>
  <div class='float-left'>
    <a href="{{route('fav.post') }}">
    <button type='submit' class='btn btn-outline-primary mb-3'>お気に入り一覧</button>
    </a>
    </div>
    <div class='float-right'>
    <a href="{{route('create.post') }}">
      <button type='submit' class='btn btn-outline-primary mb-3'>投稿ページ</button>
    </a>
  </head>
</div>
</div>
<div class="card">
  <body>
<table class='table'>
@foreach($posts as $post)
  <label for='name'>ユーザー名 : {{ $post['name'] }}</label>
  <label for='comment'>コメント : {{ $post['comment'] }}</label>
  <label for='area'>エリア : {{ $post['area_name'] }}</label>
  <label for='area'>photo : <img src="{{ asset('storage/' .$post['image_path']) }}" width="100%" height="100%"></label>
  <label for='date'>日付 : {{ $post['date'] }}</label>

<div class='text-center'>
  <iframe id='map' class='mt-2 mb-2' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $post["address"] }}'
 width='70%' height='350' frameborder='0'></iframe>
</div>

  <!-- @if(is_null($post['post_id']))
  <label>お気に入り : 登録未済</label>
　@else
  <label>お気に入り : 登録済</label>
  @endif -->

  <a href="{{route('show.comment', ['post_id' => $post['id']]) }}">
  <button type='submit' class='btn btn-link ml-2 mb-3'><コメント一覧></button>
  </a>

  <div class='text-right'>
  <div class="btn-group mb-2 mr-2" role="group" aria-label="Basic outlined example">
    @if(is_null($post['post_id']))
    <button class="fav btn btn-outline-primary" data-post="{{$post['id']}}" type="button" >お気に入り</button>
      @else
      <button class="fav btn btn-warning" data-post="{{$post['id']}}" type="button" >お気に入り</button>
      @endif

    <a href="{{ route('edit.post', ['post' => $post['id']]) }}">
    <button type="button" class="btn btn-outline-primary">編集</button>
    </a>
    <a href="{{ route('delete.post', ['post' => $post['id']]) }}">
    <button type="button" class="btn btn-outline-primary">削除</button>
    </a>
  </div>
  </div>
  <span class="border-top border-line"></span>
@endforeach
</table>

<script>
$(function(){


$(".fav").click(function(){
  var btn=$(this)
  $post_id = btn.data("post");
  console.log(btn.data("post"))
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  //基本的にはデフォルトでOK
    },
    url: '/test',  //route.phpで指定したコントローラーのメソッドURLを指定
    type: 'POST',   //GETかPOSTメソットを選択
    data: {'post_id':$post_id},
  })
  .done(function(data){
    if(btn.hasClass("btn btn-outline-primary")){

          btn.removeClass("btn btn-outline-primary");
          btn.addClass("btn btn-warning");}

          else{
          btn.removeClass("btn btn-warning");
          btn.addClass("btn btn-outline-primary");

        }
    // if($(this).hasclass("btn btn-outline-primary")){

  }).fail(function(res){
    alert("失敗");
  });
})
})
</script>

</body>
</html>


</div>
</div>

@endsection
