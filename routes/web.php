<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SigninController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'open']);
Route::get('/home', [AppController::class, 'open']);
Route::post('/', [AppController::class, 'loadMore']);
Route::post('/ajaxupload', [PostController::class, 'addLike']);

Route::get('/login', [SessionController::class, 'open']);
Route::post('/login', [SessionController::class, 'login']);

Route::get('/signin', [SigninController::class, 'open']);
Route::post('/signin', [SigninController::class, 'signin']);

Route::get('/search/{data}', [SearchController::class, 'open']);
Route::post('/search/{data}', [SearchController::class, 'setupSearch']);

Route::get('/create', [PostController::class, 'openCreate'])->name('create');
Route::post('/create', [PostController::class, 'makePost']);

Route::get('/profile/{username}', [ProfileController::class, 'open']);
Route::post('/ajaxfollow', [ProfileController::class, 'follow']);
Route::get('/editProfile/{username}', [ProfileController::class, 'openEdit'])->name('editProfile');
Route::post('/editProfile/{username}', [ProfileController::class, 'save']);
Route::get('/profile/{username}/{link}', [ProfileController::class, 'openFollowers']);

Route::get('/report/{username}', [ReportController::class, 'openRep']);
Route::post('/report/{username}', [ReportController::class, 'report']);

Route::get('/reports', [ReportController::class, 'openReports']);
Route::post('/ajaxSuspend', [ProfileController::class, 'suspend']);
Route::post('/ajaxDeletePost', [PostController::class, 'deleteRepPost']);

Route::get('/post/{postID}', [PostController::class, 'openFullPost']);
Route::post('/ajaxAddComment', [CommentsController::class, 'addComment']);
Route::post('/ajaxDeletePostUser', [PostController::class, 'deletePostUser']);
Route::get('/deletePost/{postID}', [PostController::class, 'deletePostUser']);

Route::get('/logout', function() {
    session_start();
    session_destroy();
    session_abort();
    return redirect('/login');
});

Route::view('/password-reset', 'forgotPassword');