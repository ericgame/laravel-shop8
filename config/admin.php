<?php

return [

    /*
     * 站點標題
     */
    'name' => 'Laravel Shop',

    /*
     * 頁面頂部 Logo
     */
    'logo' => '<b>Laravel</b> Shop',

    /*
     * 頁面頂部小 Logo
     */
    'logo-mini' => '<b>LS</b>',

    /*
     * Laravel-Admin 啟動文件路徑
     */
    'bootstrap' => app_path('Admin/bootstrap.php'),

    /*
     * 路由配置
     */
    'route' => [
        // 路由前綴
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        // 控制器命名空間前綴
        'namespace' => 'App\\Admin\\Controllers',
        // 默認中間件列表
        'middleware' => ['web', 'admin'],
    ],

    /*
     * Laravel-Admin 的安裝目錄
     */
    'directory' => app_path('Admin'),

    /*
     * Laravel-Admin 頁面標題
     */
    'title' => 'Laravel Shop 管理後台',

    /*
     * 是否使用 https
     */
    'secure' => env('ADMIN_HTTPS', false),

    /*
     * Laravel-Admin 用戶認證設置
     */
    'auth' => [

        'controller' => App\Admin\Controllers\AuthController::class,

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],

        // 是否展示 保持登錄 選項
        'remember' => true,

        // 登錄頁面 URL
        'redirect_to' => 'auth/login',

        // 無需用戶認證即可訪問的地址
        'excepts' => [
            'auth/login',
            'auth/logout',
            '_handle_action_',
        ]
    ],

    /*
     * Laravel-Admin 文件上傳設置
     */
    'upload' => [
        // 對應 filesystem.php 中的 disks
        'disk' => 'public',

        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
     * Laravel-Admin 數據庫設置
     */
    'database' => [

        // 數據庫連接名稱，留空即可
        'connection' => '',

        // 管理員用戶表及模型
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // 角色表及模型
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // 權限表及模型
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // 菜單表及模型
        'menu_table' => 'admin_menu',
        'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // 多對多關聯中間表
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
     * Laravel-Admin 操作日誌設置
     */
    'operation_log' => [
        /*
         * 只記錄以下類型的請求
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        'enable' => true,

        /*
         * 不記操作日誌的路由
         */
        'except' => [
           'admin/auth/logs*',
        ],
    ],

    /*
    * 路由是否檢查權限
    */
    'check_route_permission' => true,

    /*
     * 菜單是否檢查權限
    */
    'check_menu_roles'       => true,

    /*
    * 管理員默認頭像
    */
    'default_avatar' => '/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg',

    /*
     * 地圖組件提供商
     */
    'map_provider' => 'google',

    /*
     * 頁面風格
     * @see https://adminlte.io/docs/2.4/layout
     */
    'skin' => 'skin-blue-light',

    /*
     * 後台佈局
     */
    'layout' => ['sidebar-mini', 'sidebar-collapse'],

    /*
     * 登錄頁背景圖
     */
    'login_background_image' => '',

    /*
     * 顯示版本
     */
    'show_version' => true,

    /*
     * 顯示環境
     */
    'show_environment' => true,

    /*
     * 菜單綁定權限
     */
    'menu_bind_permission' => true,

    /*
     * 默認啟用麵包屑
     */
    'enable_default_breadcrumb' => true,

    /*
    * 壓縮資源文件
    */
    'minify_assets' => [
        // 不需要被壓縮的資源
        'excepts' => [

        ],
    ],
    /*
    * 啟用菜單搜索
    */
    'enable_menu_search' => true,
    /*
    * 頂部警告信息
    */
    'top_alert' => '',
    /*
    * 表格操作展示樣式
    */
    'grid_action_class' => \Encore\Admin\Grid\Displayers\DropdownActions::class,
    /*
     * 擴展所在的目錄.
     */
    'extension_dir' => app_path('Admin/Extensions'),

    /*
     * 擴展設置.
     */
    'extensions' => [
        // 新增編輯器配置開始
        'quill' => [
            // If the value is set to false, this extension will be disabled
            'enable' => true,
            'config' => [
                'modules' => [
                    'syntax' => true,
                    'toolbar' =>
                        [
                            ['size' => []],
                            ['header' => []],
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            ['script' => 'super'],
                            ['script' => 'sub'],
                            ['color' => []],
                            ['background' => []],
                            'blockquote',
                            'code-block',
                            ['list' => 'ordered'],
                            ['list' => 'bullet'],
                            ['indent' => '-1'],
                            ['indent' => '+1'],
                            'direction',
                            ['align' => []],
                            'link',
                            'image',
                            'video',
                            'formula',
                            'clean'
                        ],
                ],
                'theme' => 'snow',
                'height' => '200px',
            ]
        ]
        // 新增編輯器配置結束
    ],
];