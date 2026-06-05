<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Demo Nexus Admin template
Route::view('/demo', 'pages.demo')->name('demo');
 