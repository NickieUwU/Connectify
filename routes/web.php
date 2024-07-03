<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SigninController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'open']);
Route::get('/home', [AppController::class, 'open']);
Route::view('/about', 'about');


Route::get('/login', [SessionController::class, 'open']);
Route::post('/login', [SessionController::class, 'login']);

Route::get('/signin', [SigninController::class, 'open']);
Route::post('/signin', [SigninController::class, 'signin']);

Route::get('/search', [SearchController::class, 'open']);
Route::get('search/{search}', [SearchController::class, 'load']);

Route::get('/create', [PostController::class, 'openCreate'])->name('create');
Route::post('/create', [PostController::class, 'makePost']);

Route::get('/profile/{username}', [ProfileController::class, 'open']);
Route::post('/profile/{username}', [ProfileController::class, 'follow']);
Route::get('/editProfile/{username}', [ProfileController::class, 'openEdit']);