<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/parent' , 'cms.parent')->name('parent');
Route::view('/parent2' , 'cms.parent2')->name('parent2');
Route::view('/dashboard' , 'cms.dashboard');
Route::view('login' , 'cms.login')->name('login');
