<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('nganh','PageController@getApiNganh');
Route::post('luuhoso','PageController@luuHoSo');
Route::get('thongtin/{id}','PageController@getThongTin')->name('thongtin');
Route::get('tintuc','PageController@getTinTuc');
Route::get('cmnd','PageController@getCmnd');
Route::get('info','PageController@getInfo');
Route::get('infobycmnd','PageController@getInfoByCmnd');
