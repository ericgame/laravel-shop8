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

    //商品列表
    $router->get('products', 'ProductsController@index');

    //商品新增
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');

    //商品編輯
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');

    
});
