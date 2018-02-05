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
        $info = $file->move('upload');
        if ($info && $info->getPathname()) {
            $data=[
                'status'=>1,
                'msg'  => 'ok',
                'data'  => '/'.$info->getPathname()
            ];
            echo json_encode($data);exit;
        }

        echo json_encode(['status'=>0,'msg'=>'上传失败']);exit;

    }

}