<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/people', 'PeopleController@index')->name('people.index');
Route::get('/people/page/{page?}', 'PeopleController@index');

Route::get('/people/{people}', 'PeopleController@show')->name('people.show');
