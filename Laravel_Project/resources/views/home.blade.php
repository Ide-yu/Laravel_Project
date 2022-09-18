@extends('layout.layouts')
@section('content')
<!DOCTYPE html>
<html lang="ja">
        <main class="py-4">
          <head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
          <div class="row justify-content-around">
            <div class="card" style="width: 50rem;">
              <div class="card-header" >

                <form action="{{ route('search') }}" method="GET">

                  <div class='form-group mt-3'>
                    <div class="form-inline">

                <label for='area' class='form-group ml-4'> <エリア> </label>
                            <select name='area_id' class='form-control mr-5 ml-3'>
                              <option value="">選択してください</option>
                              @foreach($areas as $area)
                              <option value="{{ $area['id']}}">{{ $area['area_name'] }}</option>
                              @endforeach
                            </select>
                <label for='name' class='form-group '> <ユーザー名> </label>
                    <input type='search' placeholder="ユーザー名を入力" class='form-control mr-5 ml-3' name='name' value="{{ old('user_reserch')}}"/>
                    <button type="submit" class='btn btn-primary'>検索</button>
                  </div>
                  </div>
</div>
</div>
</div>
</form>
</head>
<body>
<div style="width:50%; margin: 0 auto; ">
                    <div class="card">
                    <table class='table'>
                    @foreach($posts as $post)
                      <label for='name'>ユーザー名 : {{ $post['name'] }}</label>
                      <label for='comment'>コメント : {{ $post['comment'] }}</label>
                      <label for='area'>エリア : {{ $post['area_name'] }}</label>
                      <label for='image'>photo : <img src="{{ asset('storage/' .$post['image_path']) }}" width="100%" height="100%"></label>
                      <label for='date'>日付 : {{ $post['date'] }}</label>

                      <!-- <button type="button" class="btn btn-outline-primary mr-4" >お気に入り</button> -->

<div class='text-center'>
   <iframe id='map' class='mt-2 mb-2' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $post["address"] }}'
  width='70%' height='350' frameborder='0'></iframe>
</div>




  <a href="{{route('show.comment', ['post_id' => $post['id']]) }}">
  <button type='submit' class='btn btn-link ml-2 mb-3'><コメント一覧></button>
  </a>


  <div class='res_comment_input'>
    <form action="{{ route('res.comment') }}" method='POST'>
    @csrf
    <input type='hidden' name='post_id' value="{{ $post['id'] }}">
    <input type='text' name='res_comment' class='ml-2' placeholder='コメントを追加'>
    <button class='btn btn-link' type='submit'>投稿する</button>

  </div>
</form>



<div class='text-right'>
  @if(is_null($post['post_id'])||$post['user_id']!=$login_id)
  <button class="fav btn btn-outline-primary mb-2 mr-2" data-post="{{$post['id']}}" type="button" >お気に入り</button>
  @else
  <button class="fav btn btn-warning mb-2 mr-2" data-post="{{$post['id']}}" type="button" >お気に入り</button>
  @endif
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
                        // alert("成功");
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
                </body>

        @endsection
