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
    $router->resource('tin-tucs', adminTinTuc::class);
    $router->get('tin-tucs/create', 'adminTinTuc@createNews');
    $router->post('tin-tucs/create', 'adminTinTuc@saveNews')->name('save');
    $router->get('tin-tucs/{id}/editnew', 'adminTinTuc@editNews');
    // $router->post('tin-tucs/sua-tin/{id}', 'adminTinTuc@saveEditNews')->name('save');




});
