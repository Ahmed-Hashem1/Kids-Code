<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/' , 'cms.parent');
Route::view('/dashboard' , 'cms.dashboard');
Route::view('/login' , 'cms.login');
