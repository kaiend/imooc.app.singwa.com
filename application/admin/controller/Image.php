<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-04
 * Time: 13:41
 */

namespace app\admin\controller;
use think\Request;
use app\common\lib\Upload;

class Image extends Base
{
    /**
     * 图片上传本地
     */
    public function upload1()
    {
        $file = Request::instance()->file('file');
        // halt($file);
        $info = $file->move('upload');
        if ($info && $info->getPathname()) {
            $data = [
                'status' => 1,
                'msg' => 'ok',
                'data' => '/' . $info->getPathname()
            ];
            echo json_encode($data);
            exit;
        }

        echo json_encode(['status' => 0, 'msg' => '上传失败']);
        exit;

    }

    /**
     * 图片七牛上传
     */
    public function upload()
    {
        try{
            $image = Upload::image();

        }catch (\Exception $e){
            echo json_encode(['status' => 0, 'msg' => $e->getMessage()]);

        }

        if ($image) {
            $data = [
                'status' => 1,
                'msg' => 'ok',
                'data' => config('qiniu.image_url') . '/' . $image,
            ];
            echo json_encode($data);
            exit;
        } else {
            echo json_encode(['status' => 0, 'msg' => '上传失败']);
            exit;
        }
    }

}