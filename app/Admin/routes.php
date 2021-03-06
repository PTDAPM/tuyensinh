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
    $router->resource('to-hops', AdminTohopController::class);
    $router->resource('nganh-tohops', AdminControllerNganhTohop::class);
    $router->resource('tin-tucs', AdminTinTucController::class);
    $router->resource('thong-tins', AdminThongTinController::class);
    $router->resource('tin-tucs', adminTinTuc::class);
    $router->get('tin-tucs/create', 'adminTinTuc@createNews');
    $router->post('tin-tucs/create', 'adminTinTuc@saveNews')->name('save');
    $router->get('tin-tucs/{id}/editnew', 'adminTinTuc@editNews');
    $router->resource('diems', DiemController::class);
    $router->resource('nguyen-vongs', NguyenVongController::class);
    $router->resource('khoas', KhoaController::class);
    $router->get('khoas/create', 'KhoaController@createKhoa');
    $router->post('khoas/create', 'KhoaController@saveKhoa')->name('savek');
    $router->get('tin-tucs/delete/{id}', 'adminTinTuc@delete');
    $router->get('ho-sos/delete/{id}', 'AdminHoSo@delete');






});
