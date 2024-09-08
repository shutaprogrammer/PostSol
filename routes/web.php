<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BmCoinController;

use App\Http\Controllers\TopController;

use App\Http\Controllers\MypageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/tops/create_profile', [UserController::class, 'create'])->name('profile.create');

Route::post('/tops/crete_profile', [UserController::class, 'store'])->name('profile.store');

Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/check', [PostController::class, 'show'])->name('posts.check');

Route::get('/mypages/exchange', [BmCoinController::class, 'exchange'])->name('mypages.exchange');

Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');

Route::get('/tops/question', [TopController::class, 'index'])->name('tops.question');

Route::post('/tops/question/store', [TopController::class, 'store'])->name('tops.store');

Route::get('/mypages/mypage', [MypageController::class, 'index'])->name('mypages.mypage');

Route::get('/mypages/mypage', [MypageController::class, 'show'])->name('mypages.show');