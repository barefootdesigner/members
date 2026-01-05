<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GirlController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('girls', GirlController::class)->only(['index', 'show']);
Route::get('/girls-this-week', [GirlController::class, 'week'])->name('girls.week');
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
