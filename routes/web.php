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

// Home Page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Marketplace
Route::get('/marketplace', function () {
    return view('pages.marketplace');
})->name('marketplace');

// Komunitas
Route::get('/komunitas', function () {
    return view('pages.komunitas');
})->name('komunitas');

// Edukasi
Route::get('/edukasi', function () {
    return view('pages.edukasi');
})->name('edukasi');

// Monitoring
Route::get('/monitoring', function () {
    return view('pages.monitoring');
})->name('monitoring');

// Articles
Route::prefix('artikel')->group(function () {
    Route::get('/', function () {
        return view('pages.articles.index');
    })->name('articles.index');

    Route::get('/{slug}', function ($slug) {
        return view('pages.articles.show', compact('slug'));
    })->name('articles.show');
});
