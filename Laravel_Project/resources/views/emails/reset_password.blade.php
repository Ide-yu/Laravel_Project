@extends('layout.layouts')

@section('content')

{{ $user->name }} 様
<br>
パスワード変更のご案内<br>
次のURLよりパスワードの設定を行ってログインをお願いいたします。<br>
<br>
パスワード設定URL<br>
{{ $url }}
<br>




@endsection
