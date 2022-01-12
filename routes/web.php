<?php

use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\MassSendingController;
use App\Http\Controllers\Admin\MessageTemplatesController;
use App\Http\Controllers\Mail\EmailMassSendingController;
use App\Http\Controllers\Sms\SmsMassSendingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('sending/toggle/messenger', [MassSendingController::class, 'toggle'])->name('sending.toggle');

Route::resource('customer', CustomersController::class);
Route::resource('group', GroupsController::class);
Route::resource('template', MessageTemplatesController::class);

Route::resource('sending', MassSendingController::class);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
