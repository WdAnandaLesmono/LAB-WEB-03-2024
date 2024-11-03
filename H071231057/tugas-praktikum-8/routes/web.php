<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


// routes/web.php
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route::get('/portfolio', function () {
//     return view('portfolio');
// })->name('portfolio');

// Route::get('/blog', function () {
//     return view('blog');
// })->name('blog');