<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BmCoinController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\PaymentController;

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

//home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//新規登録関連
Route::get('/home/{id}',[UserController::class, 'show'])->name('home.show');
Route::get('tops/{id}/create_profile', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/tops/{id}', [UserController::class, 'update'])->name('profile.update');

//Post
Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'check'])->name('posts.check');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

//mypage
Route::get('/mypages/exchange', [BmCoinController::class, 'exchange'])->name('mypages.exchange');
Route::get('/mypages/mypage', [MypageController::class, 'index'])->name('mypages.mypage');
Route::get('/mypages/mypage', [MypageController::class, 'show'])->name('mypages.show');
Route::Post('/mypages/mypage', [MypageController::class, 'index'])->name('mypages.mypage');

//アンケート
Route::get('/tops/question', [TopController::class, 'index'])->name('tops.question');
Route::get('/questions/index', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/questions/store', [QuestionController::class, 'store'])->name('questions.store');

//ブックマーク
Route::post('/post/{post}/bookmarks', [BookmarkController::class, 'store'])->name('bookmark');
Route::delete('/post/{post}/unbookmarks', [BookmarkController::class, 'destroy'])->name('unbookmark');

//いいね！
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('like');
Route::delete('/post/{post}/unlike', [LikeController::class, 'destroy'])->name('unlike');

//サブスク
Route::get('/mypages/subscription1', [SubscriptionController::class, 'index'])->name('mypages.subscription1');
Route::get('/mypages/subscription2', [SubscriptionController::class, 'index2'])->name('mypages.subscription2');
Route::get('/mypages/subscription3', [SubscriptionController::class, 'index3'])->name('mypages.subscription3');

Route::get('payment/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('payment/createCharge', [PaymentController::class, 'createCharge'])->name('payment.createCharge');

Route::post('/subscription/complete', [SubscriptionController::class, 'complete'])->name('subscription.complete');

Route::get('/mypage', function () {
    return view('mypages.mypage'); // mypagesディレクトリ内のmypage.blade.php
})->name('mypage');

//BMコイン購入
Route::get('/bmcoin/index1', [BmCoinController::class, 'index1'])->name('bmcoin.index1');
Route::get('/bmcoin/index2', [BmCoinController::class, 'index2'])->name('bmcoin.index2');
Route::get('/bmcoin/index3', [BmCoinController::class, 'index3'])->name('bmcoin.index3');
