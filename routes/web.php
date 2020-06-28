<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/people', 'PeopleController@index')->name('people.index');
Route::get('/people/page/{id?}', 'PeopleController@index');

Route::get('/people/{id}', 'PeopleController@show')->name('people.show');
