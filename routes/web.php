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

Route::get('/', 'CarwashController@getIndex')->name('index');


Route::get('/get-alerts/{plate}','CarwashController@getAlert')->name('getAlerts');

Route::get('/get-loyalty/{plate}','CarwashController@getLoyalty')->name('getLoyalty');

Route::post('/proccess','CarwashController@proccessWash')->name('proccessWash');

Route::get('/history','CarwashController@getHistory')->name('history');
