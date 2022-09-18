@extends('layout.layouts')
@section('content')
        <main class="py-4">
          <div class="card-header">
                            <div class='text-center'>※管理画面※</div>
                        </div>

          <div class="row justify-content-around">
            <div class="card" style="width: 50rem;">
              <div class="card-header">

                <form action="{{ route('search') }}" method="GET">
                  @csrf
                  <div class='form-group'>
                    <div class="form-inline">
                <label for='area' class='form-group'>エリア</label>
                            <select name='area_id' class='form-control'>
                              <option value="">選択してください</option>
                              @foreach($areas as $area)
                              <option value="{{ $area['id']}}">{{ $area['area_name'] }}</option>
                              @endforeach
                            </select>
                            <!-- <button type="submit" class='btn btn-primary'>検索</button> -->


                <label for='name' class='form-group'>ユーザー名</label>
                    <input type='search' placeholder="ユーザー名を入力" class='form-control' name='name' value="{{ old('user_reserch')}}"/>
                    <button type="submit" class='btn btn-primary'>検索</button>
                  </div>
                  </div>
</div>
</div>
</div>
</form>
<body>
<div style="width:50%; margin: 0 auto; ">
                    <div class="card">
                    <table class='table'>
                    @foreach($posts as $post)
                      <label for='name'>ユーザー名 : {{ $post['name'] }}</label>
                      <label for='comment'>コメント : {{ $post['comment'] }}</label>
                      <label for='area'>エリア : {{ $post['area_name'] }}</label>
                      <label for='area'>photo : <img src="{{ asset('storage/' .$post['image_path']) }}" width="100%" height="100%"></label>
                      <label for='date'>日付 : {{ $post['date'] }}</label>

                      <div class='text-right'>
                      <a href="{{ route('edit.post', ['post' => $post['id']]) }}">
                      <button type="button" class="btn btn-outline-primary">編集</button>
                      </a>
                      <a href="{{ route('delete.post', ['post' => $post['id']]) }}">
                      <button type="button" class="btn btn-outline-primary">削除</button>
                      </a>
                    </div>

                      <span class="border-top border-line"></span>
                    @endforeach
                    </table>

                    </div>
                  </div>
                </body>

        @endsection
