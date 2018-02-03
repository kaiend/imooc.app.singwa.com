<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 22:26
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    public function index()
    {
      /*  halt(session(config('admin.session_user'),'',config('admin.session_user_scope'))
    );*/
        return $this->fetch();
    }

    public function welcome()
    {
        return 'kk';
    }

}