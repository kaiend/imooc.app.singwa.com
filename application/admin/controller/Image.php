<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-04
 * Time: 13:41
 */

namespace app\admin\controller;


use think\Request;

class Image extends Base
{
    /**
     * 图片上传
     */
    public function upload()
    {
         $file = Request::instance()->file('file');
        // halt($file);
         $info=$file->move('upload');
         halt($info);
    }

}