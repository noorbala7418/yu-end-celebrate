<?php

use App\Http\Controllers\HamrahRegisterController;
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
])->name('main-confirm');

# =================== Hamrah Registration ==================

Route::get('/hamrah', [
    HamrahRegisterController::class,
    'index'
])->name('hamrah-home');

Route::post('/hamrah', [
    HamrahRegisterController::class,
    'prepareData'
])->name('hamrah-register');

Route::get('/hamrah/confirm', [
    HamrahRegisterController::class,
    'confirmPayment'
])->name('hamrah-confirm');

Route::post('/hamrah/pay/{id}',[
    HamrahRegisterController::class,
    'payment'
])->name('hamrah-pay');

# =================== Get Report ========================

Route::get('/report/students/{name}',[ // TODO: This is a too messy! and to be clean in next version
    RegisterController::class,
    'getReport'
]);

Route::get('/report/hamrahan/{name}',[ // TODO: This is a too messy! and to be clean in next version
    HamrahRegisterController::class,
    'getReport'
]);