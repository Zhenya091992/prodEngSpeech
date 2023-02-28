<?php

use App\Http\Controllers\AllEnWordsForLearnController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\EnLearningController;
use App\Http\Controllers\EnWordController;
use App\Http\Controllers\EnWordsForLearnController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('Login', [AuthController::class, 'loginForm'])->name('loginForm');

Route::post('Login', [AuthController::class, 'login'])->name('login');

Route::get('Register', [AuthController::class, 'registerForm'])->name('registerForm');

Route::post('Register', [AuthController::class, 'registration'])->name('register');

Route::resource('learning', EnLearningController::class)->only('index' , 'show');

Route::middleware(Authenticate::class)->group(function() {
    Route::get('AllLearnWords', [AllEnWordsForLearnController::class, 'table'])->name('EnglishWordsForLearn');

    Route::get('listen', [AllEnWordsForLearnController::class, 'listen'])->name('listen');

    Route::resource('EnglishWords', EnWordController::class);

    Route::resource('apiEnWordsForLearn', EnWordsForLearnController::class);

    Route::get('Cabinet', [CabinetController::class, 'index'])->name('cabinet');

    Route::get('LogOut', [AuthController::class, 'logOut'])->name('logOut');
});
