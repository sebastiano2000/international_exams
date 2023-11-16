<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserResultController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});


Route::get("/terms",function(){
    return view('TermsAndConditions');
})->name('terms');


Route::group(['prefix' => 'register'], function () {
    Route::post('/data', [RegisterController::class, 'create'])->name('register.create');
    Route::get('/verification', [RegisterController::class, 'verification'])->name('register.verification');
    Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/success', [RegisterController::class, 'success'])->name('register.success');
});

Route::group(['prefix' => 'pricing'], function () {
    Route::get('/', [PriceController::class, 'indexHome'])->name('pricing.index');
});

Route::group(['prefix' => 'we'], function () {
    Route::get('/', [HomeController::class,"index"])->name('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();

Route::group(['prefix' => 'contact'],function () {
    Route::get('/',[ContactController::class,'index'])->name('contact');
    Route::post('/modify',[ContactController::class,'modify'])->name('contact.modify');
});

Route::group(['prefix' => 'forget-password'], function () {
    Route::get('/', [ResetPasswordController::class, 'index'])->name('forget-password.reset');
    Route::post('/check', [ResetPasswordController::class, 'check'])->name('forget-password.check');
    Route::post('/change-password', [ResetPasswordController::class, 'changePassword'])->name('forget-password.change-password');
    Route::get('/change-password/verfication', [ResetPasswordController::class, 'changeForm'])->name('forget-password.change-password.form');
    Route::post('/store', [ResetPasswordController::class, 'store'])->name('forget-password.change-password.store');
    Route::get('/success', [ResetPasswordController::class, 'success'])->name('forget-password.success');
});

Route::get('/try', [QuestionController::class, "try"])->name('exam.try');

Route::group(['prefix' => 'user_result'],function(){
    Route::post('/insert/result', [UserResultController::class, "enterResult"])->name('save.data');
});

Route::group(['prefix' => 'demo'],function(){
    Route::get('/', [UserController::class, "question"])->name('demo');
});

Route::group(['prefix' => 'success'],function(){
    Route::get('/', [ContactController::class, "success"])->name('success');
});

Route::get('/', function () {
    return view('home');
});


Route::group(['prefix' => '/payment'],function(){
    Route::get('/success', [UserController::class,"paymentSucess"])->name('payment.success');
    Route::get('/failure', [UserController::class,"paymentFailure"])->name('payment.failure');
    Route::post('/save', [UserController::class,"save"])->name('payment.save');
});
