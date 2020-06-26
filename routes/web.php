<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('moveis.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('moveis.show');