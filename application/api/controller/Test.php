<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-04
 * Time: 14:11
 */

namespace app\api\controller;
use think\Controller;
class Test extends Controller
{
    public  function index()
    {
        return[
            'ss',
            'ssss'
        ];
    }
    public function update($id=0)
    {

        halt(input('put.'));
        return $id;
    }
    public function save()
    {
        //return input('post.');
        return show(1,'ok',input('post.'),201);
    }

}