<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-04
 * Time: 9:54
 */

namespace app\admin\controller;

use think\Controller;
class News extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        return $this->fetch('',[
            'cats'  => config('cat.lists')
        ]);
    }

}