<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\BmCoinController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\AmazonController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GeminiController;



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
Route::get('/tops/{id}/create_profile', [UserController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/tops/{id}', [UserController::class, 'update'])->middleware('auth')->name('profile.update');

//Post
Route::get('/posts/index', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'check'])->middleware('auth')->name('posts.check');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::post('/posts/{post}/extend', [PostController::class, 'extend'])->middleware('auth')->name('posts.extend');

//Report
Route::get('/reports/create/{post}', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports/confirm/{post}', [ReportController::class, 'confirm'])->name('reports.confirm');
Route::post('/reports/store/{post}', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reports/complete', [ReportController::class, 'complete'])->name('reports.complete');


//mypage
Route::get('/mypages/mypage', [MypageController::class, 'show'])->middleware('auth')->name('mypages.show');
Route::get('/mypages/mypage/{id}', [UserController::class, 'edit'])->middleware('auth')->name('mypages.edit');
Route::put('/mypages/{id}', [UserController::class, 'update'])->middleware('auth')->name('mypages.update');

//アンケート
Route::get('/questions/index', [QuestionController::class, 'index'])->middleware('auth')->name('questions.index');
Route::post('/questions/store', [QuestionController::class, 'store'])->middleware('auth')->name('questions.store');

//ブックマーク
Route::post('/post/{post}/bookmarks', [BookmarkController::class, 'store'])->middleware('auth')->name('bookmark');
Route::delete('/post/{post}/unbookmarks', [BookmarkController::class, 'destroy'])->middleware('auth')->name('unbookmark');

//ブックマークコインをAmazonギフト券に交換
Route::get('/mypages/exchange', [ExchangeController::class, 'index'])->middleware('auth')->name('mypages.exchange');
Route::post('/exchange/process', [ExchangeController::class, 'process'])->middleware('auth')->name('exchange.process');
Route::post('/amazon/exchange', [AmazonController::class, 'exchange'])->middleware('auth')->name('amazon.exchange');

//いいね！
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->middleware('auth')->name('like');
Route::delete('/post/{post}/unlike', [LikeController::class, 'destroy'])->middleware('auth')->name('unlike');

//サブスク
Route::get('/mypages/subscription1', [SubscriptionController::class, 'index'])->middleware('auth')->name('mypages.subscription1');
Route::get('/mypages/subscription2', [SubscriptionController::class, 'index2'])->middleware('auth')->name('mypages.subscription2');
Route::get('/mypages/subscription3', [SubscriptionController::class, 'index3'])->middleware('auth')->name('mypages.subscription3');

//ランキング
Route::get('/posts/ranking/post', [RankingController::class, 'post'])->middleware('auth')->name('rankings.post');
Route::get('/posts/ranking/user', [RankingController::class, 'user'])->middleware('auth')->name('rankings.user');

// 広告入力フォームを表示
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');

// 広告データを保存
Route::post('/ads', [AdController::class, 'store'])->name('ads.store');

// DM
Route::middleware('auth')->group(function() {
    Route::post('conversations', [MessageController::class, 'createConversation'])->middleware('auth')->name('conversations.create');
    Route::get('conversations/{conversationId}/messages', [MessageController::class, 'index'])->middleware('auth')->name('messages.index');
    Route::post('conversations/{conversationId}/messages', [MessageController::class, 'store'])->middleware('auth')->name('messages.store');
    Route::get('messages/inbox', [MessageController::class, 'inbox'])->middleware('auth')->name('messages.inbox');
});

//クレジットカード
Route::get('payment/create', [PaymentController::class, 'create'])->middleware('auth')->name('payment.create');
Route::post('payment/createCharge', [PaymentController::class, 'createCharge'])->middleware('auth')->name('payment.createCharge');

Route::post('/subscription/complete', [SubscriptionController::class, 'complete'])->middleware('auth')->name('subscription.complete');

Route::get('/mypage', function () {
    return view('mypages.mypage'); // mypagesディレクトリ内のmypage.blade.php
})->middleware('auth')->name('mypage');

//BMコイン購入
Route::get('payment/Coincreate', [PaymentController::class, 'Coincreate'])->middleware('auth')->name('payment.Coincreate');
Route::post('payment/CoinCharge', [PaymentController::class, 'CoinCharge'])->middleware('auth')->name('payment.CoinCharge');
Route::post('/Coin/Complete100', [BmCoinController::class, 'CoinComplete100'])->middleware('auth')->name('Coin.Complete100');
Route::post('/Coin/Complete200', [BmCoinController::class, 'CoinComplete200'])->middleware('auth')->name('Coin.Complete200');
Route::post('/Coin/Complete300', [BmCoinController::class, 'CoinComplete300'])->middleware('auth')->name('Coin.Complete300');
Route::post('/Coin/Complete400', [BmCoinController::class, 'CoinComplete400'])->middleware('auth')->name('Coin.Complete400');

Route::get('/bmcoin/index1', [BmCoinController::class, 'index1'])->middleware('auth')->name('bmcoin.index1');
Route::get('/bmcoin/index2', [BmCoinController::class, 'index2'])->middleware('auth')->name('bmcoin.index2');
Route::get('/bmcoin/index3', [BmCoinController::class, 'index3'])->middleware('auth')->name('bmcoin.index3');

//お問い合わせ
Route::get('/contact/form', [ContactController::class, 'form'])->middleware('auth')->name('contact.form');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->middleware('auth')->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->middleware('auth')->name('contact.send');
Route::get('/contact/complete', [ContactController::class, 'complete'])->middleware('auth')->name('contact.complete');
Route::post('/admin/inbox/{id}/status', [ContactController::class, 'status'])->middleware('auth')->name('contact.status');

//管理者画面
Route::get('/admin/menu',[AdminController::class, 'index'])->name('admin.menu');
Route::get('/admin/menu/reports',[AdminController::class, 'reports'])->name('admin.reports');


Route::get('/admin/menu/exchange',[AdminController::class, 'exchange'])->name('admin.exchange');


Route::get('/admin/menu/inbox',[AdminController::class, 'inbox'])->name('admin.inbox');
Route::get('/admin/menu/inbox/unread',[AdminController::class, 'unread'])->name('admin.inbox.unread');
Route::get('/admin/menu/inbox/inprogress',[AdminController::class, 'inprogress'])->name('admin.inbox.inprogress');
Route::get('/admin/menu/inbox/complete',[AdminController::class, 'complete'])->name('admin.inbox.complete');

//Gemini
Route::get('/gemini',[GeminiController::class, 'index'])->name('gemini.index');
Route::post('/gemini', [GeminiController::class, 'entry'])->name('entry');
