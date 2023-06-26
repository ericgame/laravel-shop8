<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    // 'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    // $router->get('/', 'HomeController@index')->name('home');
    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');

    //商品
    $router->get('products', 'ProductsController@index');

});
