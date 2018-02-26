<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 22:26
 */

/**
 * 后台基础类库
 */

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    /**
     * page
     * @var string
     */
    public $page = '';
    /**
     * 每页显示条数
     * @var string
     */
    public $size = '';

    /**
     * 初始化方法
     */
    public function _initialize()
    {
        $islogin = $this->islogin();
        if (!$islogin) {
            $this->redirect('login/index');
        }

    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function islogin()
    {
        $user = (session(config('admin.session_user'), '', config('admin.session_user_scope'))
        );//获取session
        if ($user && $user->id) {
            return true;
        }
        return false;

    }

    /**
     * 获取分页内容page and size
     */
    public function getPageAndSize()
    {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');

    }


}