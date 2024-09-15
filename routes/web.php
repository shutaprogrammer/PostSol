<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BmCoinController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminController;


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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

//新規登録関連
Route::get('/home/{id}',[UserController::class, 'show'])->name('home.show');
Route::get('/tops/{id}/create_profile', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/tops/{id}', [UserController::class, 'update'])->name('profile.update');

//Post
Route::get('/posts/index', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'check'])->middleware('auth')->name('posts.check');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

//mypage
Route::get('/mypages/mypage', [MypageController::class, 'show'])->name('mypages.show');
Route::post('/mypages/mypage', [MypageController::class, 'index'])->name('mypages.mypage');
Route::get('/mypages/mypage/{id}', [UserController::class, 'edit'])->name('mypages.edit');

Route::put('/mypages/{id}', [UserController::class, 'update'])->name('mypages.update');

//アンケート
Route::get('/tops/question', [TopController::class, 'index'])->middleware('auth')->name('tops.question');
Route::get('/questions/index', [QuestionController::class, 'index'])->middleware('auth')->name('questions.index');
Route::post('/questions/store', [QuestionController::class, 'store'])->name('questions.store');

//ブックマーク
Route::post('/post/{post}/bookmarks', [BookmarkController::class, 'store'])->name('bookmark');
Route::delete('/post/{post}/unbookmarks', [BookmarkController::class, 'destroy'])->name('unbookmark');

//ブックマークコインをAmazonギフト券に交換
Route::get('/mypages/exchange', [ExchangeController::class, 'index'])->name('mypages.exchange');
Route::post('/exchange/process', [ExchangeController::class, 'process'])->name('exchange.process');
Route::post('/amazon/exchange', [AmazonController::class, 'exchange'])->name('amazon.exchange');

//いいね！
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('like');
Route::delete('/post/{post}/unlike', [LikeController::class, 'destroy'])->name('unlike');

//サブスク
Route::get('/mypages/subscription1', [SubscriptionController::class, 'index'])->middleware('auth')->name('mypages.subscription1');
Route::get('/mypages/subscription2', [SubscriptionController::class, 'index2'])->middleware('auth')->name('mypages.subscription2');
Route::get('/mypages/subscription3', [SubscriptionController::class, 'index3'])->middleware('auth')->name('mypages.subscription3');

//クレジットカード
Route::get('payment/create', [PaymentController::class, 'create'])->middleware('auth')->name('payment.create');
Route::post('payment/createCharge', [PaymentController::class, 'createCharge'])->name('payment.createCharge');

Route::post('/subscription/complete', [SubscriptionController::class, 'complete'])->name('subscription.complete');

Route::get('/mypage', function () {
    return view('mypages.mypage'); // mypagesディレクトリ内のmypage.blade.php
})->middleware('auth')->name('mypage');

//BMコイン購入
Route::get('payment/Coincreate', [PaymentController::class, 'Coincreate'])->name('payment.Coincreate');
Route::post('payment/CoinCharge', [PaymentController::class, 'CoinCharge'])->name('payment.CoinCharge');
Route::post('/Coin/Complete100', [BmCoinController::class, 'CoinComplete100'])->name('Coin.Complete100');
Route::post('/Coin/Complete200', [BmCoinController::class, 'CoinComplete200'])->name('Coin.Complete200');
Route::post('/Coin/Complete300', [BmCoinController::class, 'CoinComplete300'])->name('Coin.Complete300');
Route::post('/Coin/Complete400', [BmCoinController::class, 'CoinComplete400'])->name('Coin.Complete400');

Route::get('/bmcoin/index1', [BmCoinController::class, 'index1'])->middleware('auth')->name('bmcoin.index1');
Route::get('/bmcoin/index2', [BmCoinController::class, 'index2'])->middleware('auth')->name('bmcoin.index2');
Route::get('/bmcoin/index3', [BmCoinController::class, 'index3'])->middleware('auth')->name('bmcoin.index3');


//管理者画面
Route::get('admin/menu',[AdminController::class, 'index'])->name('admin.menu');
Route::get('admin/menu/malicious',[AdminController::class, 'malicious'])->name('admin.malicious');
Route::get('admin/menu/exchange',[AdminController::class, 'exchange'])->name('admin.exchange');
Route::get('admin/menu/inbox',[AdminController::class, 'inbox'])->name('admin.inbox');