<?php

use Illuminate\Support\Facades\Route;


//首頁
Route::get('/', 'PagesController@root')->name('root');

/*登入、註冊
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
*/
Auth::routes();

//


