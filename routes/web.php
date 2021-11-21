<?php

use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
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

// Provider routes
Route::prefix('provider')->middleware(['auth', 'provider', 'verified'])->group(function () {
    // Gets
    Route::get('dashboard', [ProviderController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProviderController::class, 'profile'])->name('profile');
    Route::get('requests', [ProviderController::class, 'requests'])->name('requests');
    Route::get('archive', [ProviderController::class, 'archive'])->name('archive');

    Route::get('report/{id}', [ProviderController::class, 'showReport'])->name('report');

    // Posts
    Route::post('profile_store', [ProviderController::class, 'storeProvInfo'])->name('profile.store');
    Route::post('request_store', [ProviderController::class, 'storeReq'])->name('request.store');
    Route::post('request_store_alt', [ProviderController::class, 'storeReqAlt'])->name('request.store');
});

// User & entity routes
Route::prefix('user')->middleware(['auth', 'user', 'verified'])->group(function () {
    // Gets
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('request', [UserController::class, 'requestI'])->name('user.request');

    // Posts
    Route::post('request_store', [UserController::class, 'store'])->name('user.request.store');
    Route::post('profile_store', [UserController::class, 'storeProf'])->name('user.profile.store');
});

Route::redirect('/', '/login', 301);

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

require __DIR__.'/auth.php';
