<?php

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

//


