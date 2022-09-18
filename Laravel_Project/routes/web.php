<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
Route::get('/',[DisplayController::class,'index']);
// Route::get('/logout', ['uses'=>'Auth/LoginController@getLogout','as'=>'logout']);
Route::get('/logout',[LoginController::class,'logout']);

Route::get('/create_post',[RegistrationController::class, 'createPost'])->name('create.post');
Route::post('/create_post',[RegistrationController::class, 'storePost']);
Route::get('/edit_form',[RegistrationController::class, 'editPostForm'])->name('edit.post');
Route::post('/edit_form',[RegistrationController::class, 'editPost']);
Route::get('/delete_post', [RegistrationController::class, 'deletePostForm'])->name('delete.post');

Route::get('/search', [DisplayController::class, 'search'])->name('search');
Route::post('/test', [DisplayController::class, 'test']);
Route::get('/fav_post', [DisplayController::class, 'favPost'])->name('fav.post');
// Route::get('/res_comment', [DisplayController::class, 'resCommentForm'])->name('res.comment');
Route::post('/res_comment', [DisplayController::class, 'resComment'])->name('res.comment');
Route::get('/comments', [DisplayController::class, 'comments'])->name('show.comment');

});
Route::get('/my_page',[DisplayController::class,'mypage'])->name('my_page');
