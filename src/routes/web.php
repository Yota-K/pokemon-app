<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップ
Route::get('/', 'HomeController@index')->name('home');

// ユーザーページ
Route::get('/user/{id}', 'UserController@show')->name('user.show');

// 育成論のページ
Route::get('/theory/create', 'TheoryController@create')->name('theory.create');
Route::post('/theory', 'TheoryController@store')->name('theory.store');
Route::get('/theory/{id}', 'TheoryController@show')->name('theory.show');
Route::get('/theory/{id}/edit', 'TheoryController@edit')->name('theory.edit');
Route::patch('/theory/{id}', 'TheoryController@update')->name('theory.update');
Route::delete('/theory/{theory}', 'TheoryController@destroy')->name('theory.destroy');

// 認証関連
Auth::routes();
