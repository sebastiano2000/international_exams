<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserResultController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserTestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ParagraphController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserFavController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PreparatorController;
use App\Http\Controllers\ResultTotalController;
use App\Http\Controllers\UserTotalController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FinancialTransactionController;

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

Route::group(['prefix' => '/'],function(){
    Route::get('/', [AdminController::class,"dashboard"])->name('home');
});

Route::group(['prefix' => 'exam'],function(){
    Route::get('/', [QuestionController::class, "exam"])->name('exam');
    Route::get('/test', [QuestionController::class, "test"])->name('exam.test');
    Route::get('/try', [QuestionController::class, "try"])->name('exam.try');
    Route::get('/final-exam', [QuestionController::class, "finalExam"])->name('exam.final');
});

Route::group(['prefix' => 'report'],function(){
    Route::get('/', [ReportController::class,"index"])->name('report');
    Route::get('/filter',[ReportController::class,'filter'])->name('report.filter');
    Route::post('/modify',[ReportController::class,'modify'])->name('report.modify');
    Route::post('/delete/{report}',[ReportController::class,'destroy'])->name('report.delete');
});

Route::group(['prefix' => 'preparator'],function(){
    Route::get('/', [PreparatorController::class,"index"])->name('preparator');
    Route::get('/filter',[PreparatorController::class,'filter'])->name('preparator.filter');
    Route::get('/upsert/{preparator?}',[PreparatorController::class,'upsert'])->name('preparator.upsert');
    Route::post('/modify',[PreparatorController::class,'modify'])->name('preparator.modify');
    Route::post('/delete/{preparator}',[PreparatorController::class,'destroy'])->name('preparator.delete');
});

Route::group(['prefix' => 'user_result'],function(){
    Route::post('/insert/result', [UserResultController::class, "enterResult"])->name('save.data');
});

Route::group(['prefix' => 'user_total'],function(){
    Route::post('/insert/result', [UserTotalController::class, "enterResult"])->name('total.data');
});

Route::group(['prefix' => 'user_test'],function(){
    Route::post('/insert/result', [UserTestController::class, "enterResult"])->name('save.test');
});

Route::group(['prefix' => 'user_list'],function(){
    Route::post('/add/list', [UserFavController::class, "saveList"])->name('save.list');
    Route::get('/index', [UserFavController::class,"index"])->name('question.fav');
    Route::get('/exam/{question}', [UserFavController::class,"exam"])->name('question.exam');
});

Route::group(['prefix' => 'result'],function(){
    Route::get('/', [ResultController::class, "index"])->name('result');
    Route::get('/filter',[ResultController::class,'filter'])->name('result.filter');
    Route::get('/insert/total', [ResultController::class, "enterTotal"])->name('save.result');
});

Route::group(['prefix' => 'total'],function(){
    Route::get('/', [ResultTotalController::class, "index"])->name('total');
    Route::get('/filter',[ResultTotalController::class,'filter'])->name('total.filter');
    Route::get('/insert/total', [ResultTotalController::class, "enterTotal"])->name('total.result');
});

Route::group(['prefix' => 'contact'],function(){
    Route::get('/', [ContactController::class,"adminIndex"])->name('contact.admin');
    Route::get('/filter',[ContactController::class,'filter'])->name('contact.filter');
});

Route::group(['prefix' => '/payment'],function(){
    Route::post('/subscription', [UserController::class,"payment"])->name('payment.subscription');
    Route::get('/success', [UserController::class,"paymentSucess"])->name('payment.success');
    Route::get('/failure', [UserController::class,"paymentFailure"])->name('payment.failure');
    Route::post('/save', [UserController::class,"save"])->name('payment.save');
});

Route::group(['prefix' => 'user'],function(){
    Route::get('/', [UserController::class,"index"])->name('user');
    Route::post('/users', [UserController::class, 'users'])->name('users');
    Route::post('api/fetch-minor', [UserController::class, 'fetchMainor'])->name('user.fetch');
    Route::get('/upsert/{user?}',[UserController::class,'upsert'])->name('user.upsert');
    Route::get('/filter',[UserController::class,'filter'])->name('user.filter');
    Route::post('/status/update',[UserController::class,'status'])->name('user.status');
    Route::post('/status/otp',[UserController::class,'otp'])->name('user.otp');
    Route::post('/limit/update',[UserController::class,'limit'])->name('user.limit');
    Route::post('/modify',[UserController::class,'modify'])->name('user.modify');
    Route::post('/modify/password',[UserController::class,'modifyPassword'])->name('user.password');
    Route::post('/delete/{user}',[UserController::class,'destroy'])->name('user.delete');
});

Route::group(['prefix' => 'question'],function(){
    Route::get('/', [QuestionController::class,"index"])->name('question');
    Route::get('/upsert/{question?}',[QuestionController::class,'upsert'])->name('question.upsert');
    Route::post('/delete-questions-all',[QuestionController::class,'removeAll'])->name('question.dest');
    Route::get('/filter',[QuestionController::class,'filter'])->name('question.filter');
    Route::post('/delete-all',[QuestionController::class,'deleteAll'])->name('questions.delete');
    Route::post('/modify',[QuestionController::class,'modify'])->name('question.modify');
    Route::post('/delete/{question}',[QuestionController::class,'destroy'])->name('question.delete');
    Route::post('/import',[QuestionController::class,'import'])->name('question.import');
});

Route::group(['prefix' => 'paragraph'],function(){
    Route::get('/', [ParagraphController::class,"index"])->name('paragraph');
    Route::get('/upsert/{question?}',[ParagraphController::class,'upsert'])->name('paragraph.upsert');
    Route::get('/filter',[ParagraphController::class,'filter'])->name('paragraph.filter');
    Route::post('/modify',[ParagraphController::class,'modify'])->name('paragraph.modify');
    Route::post('/delete/{question}',[ParagraphController::class,'destroy'])->name('paragraph.delete');
    Route::post('/importParagraph',[ParagraphController::class,'importParagraph'])->name('paragraph.import');
    Route::post('/delete-questions-all',[ParagraphController::class,'removeAll'])->name('paragraph.dest');
});

Route::group(['prefix' => 'subject'],function(){
    Route::get('/', [SubjectController::class,"index"])->name('subject');
    Route::get('/upsert/{subject?}',[SubjectController::class,'upsert'])->name('subject.upsert');
    Route::get('/filter',[SubjectController::class,'filter'])->name('subject.filter');
    Route::post('/modify',[SubjectController::class,'modify'])->name('subject.modify');
    Route::post('/delete/{subject}',[SubjectController::class,'destroy'])->name('subject.delete');
});

Route::group(['prefix' => 'attachment'],function(){
    Route::get('/', [SubjectController::class, "indexAttachment"])->name('attachment');
    Route::get('/upsert/{attachment?}',[SubjectController::class, 'upsertAttachment'])->name('attachment.upsert');
    Route::get('/filter',[SubjectController::class,'filterAttachment'])->name('attachment.filter');
    Route::post('/modify',[SubjectController::class, 'modifyAttachment'])->name('attachment.modify');
    Route::post('/delete/{attachment}',[SubjectController::class, 'destroyAttachment'])->name('attachment.delete');
});

Route::group(['prefix' => 'profile'],function(){
    Route::get('/', [ProfileController::class, "index"])->name('profile');
    Route::post('/update', [ProfileController::class,"update"])->name('profile.update');

});

Route::group(['prefix' => 'log'],function(){
    Route::get('/', [LogController::class,"index"])->name('log');
    Route::get('/filter',[LogController::class,'filter'])->name('log.filter');
});

Route::group(['prefix' => 'prices'],function(){
    Route::get('/', [PriceController::class,"index"])->name('prices');
    Route::get('/upsert/{price?}',[PriceController::class,'upsert'])->name('prices.upsert');
    Route::post('/modify/{price?}',[PriceController::class,'modify'])->name('prices.modify');
    Route::post('/destroy/{price}',[PriceController::class,'destroy'])->name('prices.destroy');
    Route::get('/filter',[PriceController::class,'filter'])->name('prices.filter');
});

Route::group(['prefix' => 'financial_transaction'],function(){
    Route::get('/', [FinancialTransactionController::class, "index"])->name('financial_transaction');
    Route::get('/filter', [FinancialTransactionController::class, 'filter'])->name('financial_transaction.filter');
});