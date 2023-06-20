<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用戶';

    protected function grid()
    {
        $grid = new Grid(new User);

        // 創建一個列名為 ID 的列，內容是用戶的 id 字段
        $grid->id('ID');

        // 創建一個列名為 用戶名 的列，內容是用戶的 name 字段。下面的 email() 和 created_at() 同理
        $grid->name('用戶名');
        // $grid->column('name', '用戶名'); //也可以用此寫法

        $grid->email('郵箱');

        $grid->email_verified_at('已驗證郵箱')->display(function ($value) {
            return $value ? '是' : '否';
        });

        $grid->created_at('註冊時間');

        // 不在頁面顯示 `新建` 按鈕，因為我們不需要在後台新建用戶
        $grid->disableCreateButton();

        // 同時在每一行也不顯示 `編輯` 按鈕
        $grid->disableActions();

        $grid->tools(function ($tools) {
            // 禁用批量刪除按鈕
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid2()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }
}
