@extends('layout.layouts')
@section('content')
<html lang="ja">
<main class="py-4">
  <body>

<div style="width:50%; margin: 0 auto; ">

  @foreach($posts as $post)
  <form action="{{ route('edit.post', ['post' => $post['id']]) }}" method="post">
  @csrf
<div>
    <label for='comment' class='mt-2'> <コメント> </label>
     <textarea class='form-control' name='comment'>{{$post['comment'] }}</textarea>
</div>
<div>
  <label for='area' class='mt-2'> <エリア> </label>
  <select name='area_name' class='form-control'>
    @foreach($areas as $area)
    @if($area['id']==$post['area_id'])
    <option selected>{{ $area['area_name'] }}</option>
    @endif
    <option>{{ $area['area_name'] }}</option>
    @endforeach
  </select>
<label for='area'>photo : <img src="{{ asset('storage/' .$post['image_path']) }}" width="100%" height="100%"></label>

<label for='address' class='mt-2'> <観光スポット名 or 住所> </label>
<textarea class='form-control' name='address'></textarea>
  @endforeach

</div>　
<div class='row justify-content-center'>
<button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
 </div>
</form>
</div>
</body>
</html>
@endsection
