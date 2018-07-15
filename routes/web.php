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

Auth::routes();




Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/account', 'AccountController@show');

    Route::get('/log', 'LogController@show');

    Route::get('/statement/{classification}/{code}/{server}', 'StatementController@show');

    Route::get('/soa/compute/{id}','SoaController@compute');
    Route::post('/soa', 'SoaController@show');

    Route::get('/userprofile', 'UserController@show');
    Route::post('/userprofile/update', 'UserController@update');
});

//Route::get('send_test_email', function(){
//    Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
//    {
//        $message->to('jhonmarcod95@gmail.com');
//    });
//});