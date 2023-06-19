<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 使用 Gate::guessPolicyNamesUsing 方法來自定義策略文件的尋找邏輯
        Gate::guessPolicyNamesUsing(function ($class) {
            // class_basename 是 Laravel 提供的一個輔助函數，可以獲取類的簡短名稱
            // 例如傳入 \App\Models\User 會返回 User
            return '\\App\\Policies\\'.class_basename($class).'Policy';
        });
    }
}
