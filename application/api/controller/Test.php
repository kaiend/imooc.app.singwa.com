<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-04
 * Time: 14:11
 */

namespace app\api\controller;
use app\common\lib\Aes;
use think\Controller;
use app\common\lib\exception\ApiException;
class Test extends Common
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

       // halt(input('put.'));
        return $id;
    }
    public function save()
    {
        $data= input('post.');

        return show(1,'ok',(new Aes())->encrypt(json_encode(input('post.'))),201);
    }

}