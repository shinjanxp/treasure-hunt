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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/question', 'QuestionController');
Route::get('/play', 'PlayController@show');
Route::post('/play', 'PlayController@submit');


Route::get('/forum/{question?}', 'ForumController@showById');
Route::post('/forum/{question}', 'ForumController@postById');
// Route::get('/forum', 'ForumController@show');
// Route::post('/forum', 'ForumController@post');
