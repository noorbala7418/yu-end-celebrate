<?php

use App\Http\Controllers\RegisterController;
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

Route::get('/', [
    RegisterController::class,
    'index'
])->name('home');

Route::post('/register', [
    RegisterController::class,
    'prepareData'
])->name('register');

Route::post('/pay/{id}',[
    RegisterController::class,
    'payment'
])->name('pay');


Route::get('/confirm', [
    RegisterController::class,
    'confirmPayment'
])->name('confirm');

Route::get('/report/{name}',[ // TODO: This is a messy! and to be clean in next version
    RegisterController::class,
    'getReport'
]);

