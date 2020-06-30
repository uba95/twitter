<?php

// DB::listen(function ($query) { 
//     echo '<pre>';
//     var_dump($query->sql, $query->bindings);
//     echo '</pre>';
// });


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => true]);
// Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function() {
    if (Auth::check()) {
        return redirect('/tweets');   
    } else {
        return view('welcome');
    }
});  
// Route::get('/', 'WelcomeController');
Route::redirect('/home', '/tweets');

Route::middleware(['auth', 'verified'])->group(function () {

    // Route::redirect('/', '/tweets');
    Route::get('/tweets', 'TweetController@index')->name('home');
    Route::post('/tweets', 'TweetController@store');
    Route::delete('/tweets/{tweet}/delete', 'TweetController@destroy')->middleware('can:delete,tweet');
    Route::post('/tweets/{tweet}/like', 'TweetLikeController@store')->name('like');

    Route::post('/profiles/{user:username}/follow', 'FollowController@store');
    Route::get('/profiles/{user:username}/edit', 'ProfileController@edit')->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}/cover', 'CoverController');
    Route::patch('/profiles/{user:username}', 'ProfileController@update')->middleware('can:edit,user');
    

    Route::get('/explore', 'ExploreController@index');
    Route::get('/notifications', 'NotificationsController');
});
Route::get('/profiles/{user:username}', 'ProfileController@show')->name('profile');
Route::get('/friends/{user:username}', 'FriendController');

// Auth::loginUsingId(21);