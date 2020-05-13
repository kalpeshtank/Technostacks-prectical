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
Auth::routes(['register' => false]);
Route::get('/', function () {
    return redirect('login');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('subjects', 'SubjectController');
Route::resource('questions', 'QuestionsController');
Route::resource('questions-options', 'OrderDeliverysController');
Route::resource('users-results', 'OrderDeliverysController');
