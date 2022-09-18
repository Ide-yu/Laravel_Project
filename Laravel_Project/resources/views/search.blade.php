@extends('layout.layouts')
@section('content')
  <main class="py-4">


    <body>
    <div style="width:50%; margin: 0 auto; ">
                        <div class="card">
                        <table class='table'>
                        @foreach($items as $item)
                          <label for='name'>ユーザー名 : {{ $item->name }}</label>
                          <label for='comment'>コメント : {{ $item->comment }}</label>
                          <label for='area'>エリア : {{ $item->area_name }}</label>
                          <label for='area'>photo : <img src="{{ asset('storage/' .$item['image_path']) }}" width="100%" height="100%"></label>
                          <label for='date'>日付 : {{ $item->date }}</label>
                          <span class="border-top border-line"></span>
                        @endforeach
                        </table>

                        </div>
                      </div>
                    </body>







  @endsection
