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

Route::get('/','PageController@getNganh');
Route::post('hoso','PageController@luuHoso');
//Route::get('multiuploads','PageController@uploadForm');
//Route::post('multiuploads','PageController@uploadSubmit');
