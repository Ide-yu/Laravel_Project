<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Area;
use App\Favorite;
use App\Post;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
  public function createPost(Request $request){

    $area = new Area;
    $areas = $area->all()->toArray();

    return view('post',[
      'areas' => $areas,
      ]);
}

        public function storePost(Request $request)
        {
        // 画像フォームでリクエストした画像を取得
        $img = $request->file('image_path');
        // storage > public > img配下に画像が保存される
        $path = $img->store('img','public');
        // DBに登録する処理
        $login_id = Auth::user()->id;

        $area = new Area;
        $area_name = $request->area_name;
        $area_record = $area
                        ->where('area_name','=',$area_name)
                        ->get()
                        ->toArray();

        $post = new Post;
        $post->user_id = $login_id;
        $post->image_path = $path;
        $post->area_id = $area_record[0]['id'];
        $post->comment = $request->comment;
        $post->date = today();
        $post->address = $request->address;
        //
        $post->save();

        return redirect('/my_page');
        }

        public function editPostForm(Request $request)
        {
          $post_id = $request -> post;
          var_dump($post_id);
          $post = new Post;
          // $result = $post->find($request->id);
          $login_id = Auth::user()->id;
          $post_with_area = $post
                         ->join('areas', 'posts.area_id','areas.id')
                         ->select('posts.id','comment','area_name','area_id','image_path','date','address')
                         ->where('posts.id','=',$post_id)
                         ->get()
                         ->toArray();
          $area = new Area;
          $areas = $area->all()->toArray();

        return view('edit_post',[
        'posts' => $post_with_area,
        'areas' => $areas,
        ]);
        }

        public function editPost(Request $request)
        {
          $post = new Post;
          $area = new Area;
          $post_id = $request -> post;
          $area_name = $request -> area_name;

          $record = $post->find($post_id);
          $area_record = $area
                          ->where('area_name','=',$area_name)
                          ->get()
                          ->toArray();
          $record->comment = $request->comment;
          $record->area_id = $area_record[0]['id'];
          $post->address = $request->address;
          $record->save();
    return redirect('/my_page');
        }

        // 論理削除　0:表示　1:非表示
        public function deletePostForm(Request $request){

    $post = new Post;
    $post_id = $request -> post;

    $record = $post->find($post_id);
    $record->del_flg = '1' ;
    $record->save();
    // UPDATE spendings ::where('del_flg', '1')->get();
    return redirect('/my_page');
    // );
    //
}

}
