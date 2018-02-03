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
     * 初始化方法
     */
    public function _initialize()
    {
        $islogin = $this ->islogin();
        if (!$islogin){
            $this->redirect('login/index');
        }

    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function islogin()
    {
        $user = (session(config('admin.session_user'),'',config('admin.session_user_scope'))
        );//获取session
        if ($user && $user->id){
            return true;
        }
        return false;

    }


}