$(
  function(){
    $('.test').on('click','test', function (){
      alert("aaa");
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  //基本的にはデフォルトでOK
        },
        url: '/search',  //route.phpで指定したコントローラーのメソッドURLを指定
        type: 'POST',   //GETかPOSTメソットを選択
        data: { 'product_id': product_id, 'like_product': like_product, }, //コントローラーに送るに名称をつけてデータを指定
      })
    }
  }
);
