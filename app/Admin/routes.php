<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('ho-sos', AdminHoSo::class);
    $router->resource('nganhs', AdminNganhController::class);
    $router->resource('hoso-nganhs', AdminHosoNganh::class);
    $router->resource('tohops', AdminTohopController::class);
    $router->resource('nganh-tohops', AdminControllerNganhTohop::class);
    $router->resource('tin-tucs', AdminTinTucController::class);
    $router->resource('thong-tins', AdminThongTinController::class);




});
