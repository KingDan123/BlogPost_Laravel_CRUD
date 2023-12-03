<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //not to get error when we are not loged in
    $posts=[];
    // if we loged in we see our own post
    if(auth()->check()){
        $posts=auth()->user()->userPosts()->latest()->get();
    }
   // $posts=Post::all();
    // only to see users post
    //$post=Post::where('user_id',auth()->id())->get();
    return view('home',['posts'=>$posts]);
});

Route::POST('/register', [UserController::class, 'register']);
Route::post('/logout' , [UserController::class,'logout']);
Route::post('/login' , [UserController::class,'login']);

//Post control
Route::Post('/create-post',[PostController::class,'createPost']);
//get user post
Route::get('/edit-post/{post}',[PostController::class,'showEdit']);
// to update post change 
Route::put('/edit-post/{post}',[PostController::class,'updatePost']);
//delete post 
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);