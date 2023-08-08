<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

//首頁
Route::get('/', 'PagesController@root')->name('root');

/*登入、註冊、密碼、email認證、登出
| GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
| POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |

| POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web                                         |

| GET|HEAD | password/confirm       | password.confirm | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\Authenticate            |
| POST     | password/confirm       |                  | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\Authenticate            |
| POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web                                         |
| GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web                                         |
| POST     | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web                                         |
| GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web                                         |

| GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
| POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web                                         |
|          |                        |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |

| POST     | email/resend             | verification.resend | App\Http\Controllers\Auth\VerificationController@resend                | web                                                |
|          |                          |                     |                                                                        | App\Http\Middleware\Authenticate                   |
|          |                          |                     |                                                                        | Illuminate\Routing\Middleware\ThrottleRequests:6,1 |
| GET|HEAD | email/verify             | verification.notice | App\Http\Controllers\Auth\VerificationController@show                  | web                                                |
|          |                          |                     |                                                                        | App\Http\Middleware\Authenticate                   |
| GET|HEAD | email/verify/{id}/{hash} | verification.verify | App\Http\Controllers\Auth\VerificationController@verify                | web                                                |
|          |                          |                     |                                                                        | App\Http\Middleware\Authenticate                   |
|          |                          |                     |                                                                        | Illuminate\Routing\Middleware\ValidateSignature    |
|          |                          |                     |                                                                        | Illuminate\Routing\Middleware\ThrottleRequests:6,1 |
*/
Auth::routes(['verify' => true]);

// auth中間件 代表需要登錄，verified中間件 代表需要經過郵箱驗證
Route::group(['middleware' => ['auth', 'verified']], function() {
    // 收貨地址列表
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');

    // 新增收貨地址
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');

    // 修改收貨地址
    Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');

    // 刪除收貨地址
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    //收藏商品
    Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
    Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');

    //收藏商品
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

    //購物車
    Route::post('cart', 'CartController@add')->name('cart.add');

    //購物車列表
    Route::get('cart', 'CartController@index')->name('cart.index');

    //購物車列表:刪除
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    //訂單
    Route::post('orders', 'OrdersController@store')->name('orders.store');

});

Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');

//商品詳情
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

