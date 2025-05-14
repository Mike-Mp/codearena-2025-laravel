<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post');

Route::get('/authors/{user}', [PostController::class, 'index'])->name('author');

Route::get('/promoted', [PostController::class, 'promoted'])->name('promoted');

Route::post('/comments', [CommentsController::class, 'store'])->name('comment');

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::resource('comments', CommentController::class)->except(['store']);
});