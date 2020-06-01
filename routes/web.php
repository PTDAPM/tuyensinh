<?php

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

Route::get('/','PageController@index');
Route::get('ajax/maxettuyen','PageController@ajaxGetMa');
Route::get('thongtin/{id}','PageController@getThongTin')->name('thongtin');
//Route::get('multiuploads','PageController@uploadForm');
//Route::post('multiuploads','PageController@uploadSubmit');
