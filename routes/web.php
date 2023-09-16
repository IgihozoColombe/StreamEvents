<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/view', function () {
    return view('example');
});
Route::get('/dashboard', function () {
    return view('display');
});

Route::get('/newFollower', function () {
    return view('create');
});

Route::get('/newDonation', function () {
    return view('donation');
});

Route::get('/newMerch', function () {
    return view('merch');
});

Route::get('/newSubscriber', function () {
    return view('subscriber');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

