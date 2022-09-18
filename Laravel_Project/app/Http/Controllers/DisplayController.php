<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Area;
use App\Favorite;
use App\Post;
use App\User;
use App\Comment;

use Illuminate\Support\Facades\Auth;


class DisplayController extends Controller
{
  public function index(){
    $login_id = Auth::user()->id;
    $area = new Area;
    $post = new Post;
    $comment = new Comment;

    $post_with_area = $post
    ->join('areas', 'posts.area_id','areas.id')
    ->join('users', 'posts.user_id', 'users.id')
    ->leftjoin('favorites', 'posts.id', 'favorites.post_id')
    ->select('posts.id','users.name','comment','area_name','image_path','date', 'favorites.post_id','favorites.user_id','address')
    ->where('del_flg','=','0')
    ->orderby('id','desc')
    ->get()
    ->toArray();

    $areas = $area->all()->toArray();

        return view('home')->with([
       'posts' => $post_with_area,
       'areas' => $areas,
       'login_id' => $login_id,
    ]);

    }

    public function mypage(Request $request){

      $post = new Post;
      $area = new Area;
      $login_id = Auth::user()->id;

     $post_with_area = $post
                    ->join('areas', 'posts.area_id','areas.id')
                    ->join('users', 'posts.user_id', 'users.id')
                    ->leftjoin('favorites', 'posts.id', 'favorites.post_id')
                    ->select('posts.id','users.name','comment','area_name','image_path','date', 'favorites.post_id','address')
                    ->where('del_flg','=','0')
                    ->where('posts.user_id','=',$login_id)
                    ->orderby('id','desc')
                    ->get()
                    ->toArray();
                    // var_dump($post_with_area);
      $post_with_area_all = $post
                    ->join('areas', 'posts.area_id','areas.id')
                    ->join('users', 'posts.user_id', 'users.id')
                    ->select('posts.id','users.name','comment','area_name','image_path','date')
                    ->where('del_flg','=','0')
                    ->orderby('id','desc')
                    ->get()
                    ->toArray();

      $user = new User;
      $user_auth = $user
                     ->where('id','=',$login_id)
                     ->get()
                     ->toArray();

      $areas = $area->all()->toArray();

      //実験
          // $favorite = new Favorite;
          // $favorite_wk= $favorite
          //             ->where('user_id', '=', 1)
          //             ->where('post_id', '=', 40);
          // $favorite_count = $favorite_wk->count();
          // var_dump($favorite_count);

      if($user_auth[0]["adm_flg"]==0) {
        return view('mypage')->with([
          'posts' => $post_with_area,
      ]);
    }else{
      return view('adm/adm_page')->with([
        'posts' => $post_with_area_all,
        'areas' => $areas,
        ]);
    }

}

   public function search(Request $request){

     //検索フォームに入力された値を取得
       $area_name = $request->input('area_id');
       $user_name = $request->input('name');


     $query = Post::query();
         //テーブル結合
         $query->join('areas', function ($query) use ($request) {
             $query->on('posts.area_id', '=', 'areas.id');
           })->join('users', function ($query) use ($request) {
             $query->on('posts.user_id', '=', 'users.id');
             });


             if(!empty($area_name)) {
            $query->where('area_id', 'LIKE', $area_name);
        }

        if(!empty($user_name)) {
            $query->where('name', 'LIKE', "%{$user_name}%");
        }


        $items = $query->where('del_flg','=','0')->get();

        $area_name_list = Area::all();
        $user_name_list = User::all();

// var_dump($area_name_list);
        return view('search',
        compact('areas', 'items', 'area_name', 'name', 'area_name_list', 'user_name_list'));
    }
    public function test(Request $request){
      $login_id = Auth::user()->id;
      $post_id = $request->input('post_id');
      $favorite = new Favorite;
      $favorite_wk = $favorite ->where('user_id', '=', $login_id)
                               ->where('post_id', '=', $post_id);
      $favorite_count = $favorite_wk->count();
      if($favorite_count == 0){
      $favorite = new Favorite;
      $favorite -> user_id = $login_id;
      $favorite -> post_id = $post_id;
      $favorite ->save();
      }else{
      $favorite = new Favorite;
      $favorite_id = $favorite
                     ->where('user_id', '=', $login_id)
                     ->where('post_id', '=', $post_id)
                     ->get()
                     ->toArray();
      $favorite->destroy($favorite_id[0]['id']);
      }
    }


    public function favPost(Request $request){

      $post = new Post;
      $login_id = Auth::user()->id;

      $post_with_area = $post
                     ->join('areas', 'posts.area_id','areas.id')
                     ->join('users', 'posts.user_id', 'users.id')
                     ->leftjoin('favorites', 'posts.id', 'favorites.post_id')
                     ->select('posts.id','users.name','comment','area_name','image_path','date', 'favorites.post_id')
                     ->where('del_flg','=','0')
                     ->where('favorites.user_id','=',$login_id)
                     ->orderby('id','desc')
                     ->get()
                     ->toArray();

      return view('favorite')->with([
     'posts' => $post_with_area,

  ]);

    }

        public function resComment(Request $request)
   {
       $comment = new Comment();
       $comment->res_comment = $request->res_comment;
       $comment->post_id = $request->post_id;
       $comment->user_id = Auth::user()->id;
       $comment->save();

       return redirect('/');
   }


   public function comments(Request $request){

     $comment = new Comment;
     $post_id = $request->input('post_id');
       $comment_with_post = $comment
       // ->join('posts', 'comments.post_id', 'posts.id')
       ->join('users', 'comments.user_id', 'users.id')
       ->select('name','res_comment','comments.created_at')
       ->where('post_id','=',$post_id)
       ->orderby('comments.created_at','desc')
       ->get()
       ->toArray();


       return view('comments',[
         'comments' => $comment_with_post
         ]);



}
    //
}
