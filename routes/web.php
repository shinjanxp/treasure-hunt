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
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/home', 'HomeController@index');

Route::resource('/question', 'QuestionController');
Route::get('/play', 'PlayController@show');
Route::post('/play', 'PlayController@submit');


Route::get('/forum/{question?}', 'ForumController@showById');
Route::post('/forum/{question}', 'ForumController@postById');
// Route::get('/forum', 'ForumController@show');
// Route::post('/forum', 'ForumController@post');
Route::get('/leaderboard',function(){
    $questions = \App\Question::all();
    $users= App\User::with('submissions')->where('is_admin','=',false)->get()->sortBy(function($user) use ($questions){
        return ($questions->last()->id-$user->level)*10000 + $user->submissions->count();
        
    });
    $last_level = $questions->last()->id;
    return view('leaderboard')->with(compact('users','last_level'));
});