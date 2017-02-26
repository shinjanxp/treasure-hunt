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
Route::get('/artisan/migrate/refresh/{key?}',  array('as' => 'refresh', function($key = null)
{
    if($key == env('APP_SECRET')){
    try {
      
      echo '<br>refresh with app tables migrations...';
      \Artisan::call('migrate:refresh');
      echo '<br>done with app tables migrations';
      
    } catch (Exception $e) {
      Response::make($e->getMessage(), 500);
    }
  }else{
    App::abort(404);
  }
}));
Route::get('/artisan/migrate/seed/{key?}',  array('as' => 'refresh', function($key = null)
{
    if($key == env('APP_SECRET',null)){
    try {
      
      echo '<br>seed with app tables migrations...';
      \Artisan::call('db:seed');
      echo '<br>done with app tables migrations';
      
    } catch (Exception $e) {
      Response::make($e->getMessage(), 500);
    }
  }else{
    App::abort(404);
  }
}));
Route::get('/artisan/migrate/rollback/{key?}',  array('as' => 'refresh', function($key = null)
{
    if($key == env('APP_SECRET',null)){
    try {
      
      echo '<br>rollback with app tables migrations...';
      \Artisan::call('migrate:rollback');
      echo '<br>done with app tables migrations';
      
    } catch (Exception $e) {
      Response::make($e->getMessage(), 500);
    }
  }else{
    App::abort(404);
  }
}));
Route::get('/artisan/migrate/{key?}',  array('as' => 'migrate', function($key = null)
{
    if($key == env('APP_SECRET',null)){
    try {
      
      echo '<br>init with app tables migrations...';
      \Artisan::call('migrate');
      echo '<br>done with app tables migrations';
      
    } catch (Exception $e) {
      Response::make($e->getMessage(), 500);
    }
  }else{
    App::abort(404);
  }
}));

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/home', 'HomeController@index');

Route::resource('/question', 'QuestionController');
Route::get('/play', 'PlayController@show');
Route::post('/play', 'PlayController@submit');
Route::post('/reset', 'PlayController@reset');

Route::get('/forum/{question?}', 'ForumController@showById');
Route::post('/forum/{question}', 'ForumController@postById');
// Route::get('/forum', 'ForumController@show');
// Route::post('/forum', 'ForumController@post');
Route::get('/leaderboard',function(){
    $questions = \App\Question::all();
    $users= App\User::with('submissions')->where('is_admin','=',false)->orderBy('level','DESC')->orderBy('last_level_cleared_at','ASC')->get();
    // $users= App\User::with('submissions')->where('is_admin','=',false)->get()->sortBy(function($user) use ($questions){
    //     return ($questions->last()->id-$user->level)*10000 + $user->submissions->count();
        
    // });
    $last_level = $questions->last()->id;
    return view('leaderboard')->with(compact('users','last_level'));
});