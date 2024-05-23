<?php

use App\Http\Controllers\Connect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

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

Route::view('/', 'welcome')
    ->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/connect', [Connect::class, 'connect'])
    ->name('connect');

Route::get('/rejected', function () {
    return redirect('/')->withErrors(['connection' => 'Connection rejected by user.']);
})->name('rejected');

Route::get('/site/{site}', [InstallController::class, 'install'])
    ->name('install');

require __DIR__.'/auth.php';
