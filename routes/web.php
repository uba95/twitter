<?php

// DB::listen(function ($query) { 
//     echo '<pre>';
//     var_dump($query->sql, $query->bindings);
//     echo '</pre>';
// });


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() { 

        Auth::routes(['verify' => true]);
        // Route::get('/logout', 'Auth\LoginController@logout');

        Route::get('/', function() {

            return Auth::check() ? redirect('/tweets') : view('welcome');
        });  
        // Route::get('/', 'WelcomeController');
        Route::redirect('/home', '/tweets');

        Route::middleware(['auth', 'verified'])->group(function () {

            // Route::redirect('/', '/tweets');
            Route::group(['prefix' => 'tweets'], function () {

                Route::get('', 'TweetController@index')->name('home');
                Route::post('', 'TweetController@store');
                Route::delete('{tweet}/delete', 'TweetController@destroy')->middleware('can:delete,tweet')->name('tweet.delete');
                Route::post('{tweet}/like', 'TweetLikeController@store')->name('like');
            });
            // Route::resource('tweets', 'TweetController')->only(['index', 'store', 'destroy']);

            Route::group(['prefix' => 'profiles'], function () {

                Route::post('{user:username}/follow', 'FollowController@store')->name('follow');
                Route::get('{user:username}/edit', 'ProfileController@edit')->middleware('can:edit,user');
                Route::patch('{user:username}/cover', 'CoverController');
                Route::patch('{user:username}', 'ProfileController@update')->middleware('can:edit,user');
            });


            Route::get('/explore', 'ExploreController@index');
            Route::get('/notifications', 'NotificationsController');
        });


        Route::get('/profiles/{user:username}', 'ProfileController@show')->name('profile');
        Route::get('/friends/{user:username}', 'FriendController');

        Route::get('/redirect/{service}', 'SocialController@redirect');
        Route::get('/callback/{service}', 'SocialController@callback');
        // Auth::loginUsingId(1);


});
Route::post('/save-device-token','FollowController@saveToken');
// Route::post('/sendPush','FirebaseController@sendPush')->name('send-push');
