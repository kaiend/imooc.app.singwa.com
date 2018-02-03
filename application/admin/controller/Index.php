<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-03
 * Time: 15:59
 */

namespace app\admin\controller;

use app\admin\controller\Base;
use think\Controller;

class Index extends Base
{
    public function _initialize()
    {

    }

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