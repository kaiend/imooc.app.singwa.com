<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-03
 * Time: 9:27
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

}