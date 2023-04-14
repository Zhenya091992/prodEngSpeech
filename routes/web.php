<?php

use App\Http\Controllers\APIEnWords;
use App\Http\Controllers\APIEnWordsAction;
use App\Http\Controllers\APIListen;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/words', function () {
    return Inertia::render('Words/AllWords');
})->middleware(['auth', 'verified'])->name('words');

Route::get('/listen', function () {
    return Inertia::render('Player/listen');
})->middleware(['auth', 'verified'])->name('listen');

Route::get('api/listen/allLearnedWords', [APIListen::class, 'listen'])->middleware(['auth', 'verified']);

Route::get('api/enWords/all', [APIEnWords::class, 'all'])->middleware(['auth', 'verified']);
Route::get('api/enWords/learn', [APIEnWords::class, 'learn'])->middleware(['auth', 'verified']);
Route::get('api/enWords/learned', [APIEnWords::class, 'learned'])->middleware(['auth', 'verified']);
Route::get('api/enWords/action', [APIEnWords::class, 'action'])->middleware(['auth', 'verified']);
Route::get('api/enWords/addToLearn', [APIEnWordsAction::class, 'addRandWords'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
