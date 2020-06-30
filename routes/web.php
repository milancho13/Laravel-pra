<?php

//phpinfo();

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
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Google
Route::get('google/login/redirect', 'Auth\SocialController@getGoogleAuth');
Route::get('google/login/callback', 'Auth\SocialController@getGoogleAuthCallback');

//Facebook
Route::get('auth/facebook', 'Auth\SocialController@getFacebookAuth');
Route::get('auth/facebook/callback', 'Auth\SocialController@getFacebookAuthCallback');
//Route::get('auth/facebook/logout', 'Auth\AuthController@getLogout');

//chat
// Route::get('chat', 'ChatController@home');
// Route::get('/chat/{recieve}', 'ChatController@index')->name('chat');
// Route::post('/chat/send', 'ChatController@store')->name('chatSend');

//Line chat
Route::post('qr-bot', 'QrBotController@reply');
