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

//create middleware here if customer code is not existing or related to email address will force logout
//middleware also for soa id that is not belongs to customer

Route::group(['middleware' => 'auth'], function () {

    #logs page use by admin user
    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::get('/log', 'LogController@show');
        Route::get('/log-history', 'LogController@log_history');
        Route::get('/soa-master', 'SoaMasterController@index');
    });

    #account page
    Route::group(['middleware' => 'account.out'], function () {
        Route::get('/', 'AccountController@show')->name('home');
        Route::get('/home', 'AccountController@show')->name('home');

        Route::post('/account', 'AccountController@setAccount');
    });

    #allowed links to access upon account selection
    Route::group(['middleware' => 'account.in'], function () {

        Route::get('/dashboard', 'HomeController@index');

        Route::get('/users', 'UserController@users');
        Route::get('/users/add', 'UserController@add');
        Route::get('/users/edit/{id}', 'UserController@edit');

        Route::post('/users/save', 'UserController@save');
        Route::post('/users/accounts/save', 'UserController@saveAccount');
        Route::post('/users/accounts/update', 'UserController@updateAccount');
        Route::post('/users/accounts/delete/{id}', 'UserController@deleteAccount');

        Route::get('/history', 'StatementHistoryController@show');

        Route::get('/account/switch', 'AccountController@switchAccount');

        Route::get('/statement/{classification}/{code}/{server}', 'StatementController@show');

        Route::get('/soa/compute/{id}','SoaController@compute');
        Route::post('/soa', 'SoaController@show');
    });




    #user profile
    Route::get('/userprofile', 'UserController@show');
    Route::post('/userprofile/update', 'UserController@update');
});

