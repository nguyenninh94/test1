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

Route::get('/check-relationship-status/{id}', [
    'uses' => 'FriendshipController@check',
    'as' => 'check'
 ]);

Route::get('/add-friend/{id}', [
    'uses' => 'FriendshipController@add_friend',
    'as' => 'add_friend'
 ]);


Route::get('/accept-friend/{id}', [
    'uses' => 'FriendshipController@accept_friend',
    'as' => 'accept_friend'
 ]);

Route::get('notifications', [
    'uses' => 'HomeController@notifications',
    'as' => 'notifications'
]);

Route::get('feed', [
    'uses' => 'FeedController@feed',
    'as' => 'feed'
]);

Route::get('/get-auth-user-data', function() {
    return Auth::user();
});


Route::get('/get-unread', function() {
   return Auth::user()->unreadNotifications;
});


Route::group(['middleware' => 'auth'], function() {
	Route::get('/profile/{slug}', [
       'uses' => 'ProfileController@index',
       'as' => 'profile.index'
	]);

	Route::get('/profile/edit/profile', [
       'uses' => 'ProfileController@edit',
       'as' => 'profile.edit'
	]);

	Route::post('/profile/update/profile', [
       'uses' => 'ProfileController@update',
       'as' => 'profile.update'
	]);

  Route::get('/like/{id}', [
       'uses' => 'LikeController@like'
  ]);

  Route::get('/dislike/{id}', [
       'uses' => 'LikeController@dislike'
  ]);

  Route::resource('post', 'PostController');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/fix', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize');
});