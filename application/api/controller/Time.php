<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-13
 * Time: 12:48
 */

namespace app\api\controller;


use think\Controller;

class Time extends Controller
{
    public function index()
    {
        return show(1,'ok',time());
    }

}