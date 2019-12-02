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

Route::get('/','QuizzController@homeQuizz')->name('homeQuizz');

Route::get('/quizz','QuizzController@homeQuizz')->name('homeQuizz');

Route::get('/quizz/active', 'QuizzController@activeQuizz')->name('activeQuizz');

Route::get('/quizz/archived', 'QuizzController@archiveQuizz')->name('archiveQuizz');

Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/login', 'Auth\LoginController@view')->name('loginView');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@view')->name('registerView');

Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/admin/checkquizz', 'QuizzController@checkView')->name('admin.checkquizz.view');
Route::post('/admin/checkquizz', 'QuizzController@checkIterations')->name('admin.checkquizz.post');

Route::get('/quizz/{id}','QuizzController@questions')->name('questions');

Route::post('/quizz/{id}/validate','QuizzController@validateResponses')->name('validateResponses');

Route::get('/friend','RelationshipController@friend')->name('friend');
