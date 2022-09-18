@extends('layout.layouts')
@section('content')

<div style="width:50%; margin: 0 auto; ">
    <form action="{{ route('create.post') }}" method="post" enctype="multipart/form-data">
          @csrf
        <div>
            <label for='comment' class='mt-2'> <コメント> </label>
            <textarea class='form-control' name='comment'></textarea>
        </div>
        <div>
          <label for='area' class='mt-2'> <エリア> </label>
                      <select name='area_name' class='form-control'>
                        @foreach($areas as $area)
                        <option>{{ $area['area_name'] }}</option>
                        @endforeach
                      </select>
                      <label for='image' class='mt-2'> <画像選択> </label>
                      <input type="file" name="image_path">
                      <br>
                      <label for='address' class='mt-2'> <観光スポット名 or 住所> </label>
                      <textarea class='form-control' name='address'></textarea>



        </div>　
        <div class='row justify-content-center'>
        <button type='submit' class='btn btn-primary w-25 mt-3'>投稿</button>
         </div>
      </form>
</div>
@endsection
