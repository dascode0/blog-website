<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavePostController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-posts', [HomeController::class, 'search'])->name('search.posts');


//login page routers
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login-success', [LoginController::class, 'check'])->name('login.save');


//register page routers
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register_save', [RegisterController::class, 'addUser'])->name('register.save');
Route::get("/account-delete", [RegisterController::class, 'accountdelete'])->name('account.delete');

//profile page router

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.show');
Route::get('/logout', [ProfileController::class, 'logout'])->name('user.logout');

//edit profile route
Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('editprofile.page');
Route::post('/editprofile-save', [ProfileController::class, 'updateprofile'])->middleware('auth')->name('updateprofile.save');
//create post router

Route::get('/create-post', [PostController::class, 'index'])->name('postcreate-show');
Route::post('/insert-post', [PostController::class, 'insert'])->name('post.create');
//edit post route
Route::get('/edit-post/{id}', [PostController::class, 'editpost'])->name('edit.post');
Route::put('/editpost-save/{id}', [PostController::class, 'editpostsave'])->name('editpost.save');
//delete post
Route::get('/delete-post/{id}', [PostController::class, 'deletepost'])->name('delete.post');

//post save router
Route::post('/save-post/{id}', [SavePostController::class, 'savePost'])->name('post.save');
Route::post('/unsave-post/{id}', [SavePostController::class, 'unsavePost'])->name('post.unsave');

//post like router
Route::post('/like-post/{id}', [LikePostController::class, 'likePost'])->name('post.like');
Route::post('/unlike-post/{id}', [LikePostController::class, 'unlikePost'])->name('post.unlike');


//post show route

Route::get('/post-show/{id}', [PostShowController::class, 'index'])->name('post.show');

//comment route
Route::get('/posts/{post}/comments', [CommentController::class, 'fetch'])->name('comments.fetch');
Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth')->name('add.comment');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth');
