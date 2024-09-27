<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/all/data',[\App\Http\Controllers\HomeController::class,'data']);
