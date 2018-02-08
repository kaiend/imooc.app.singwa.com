<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018-02-06
 * Time: 9:52
 */

namespace app\common\lib;
vendor('qiniu.autoload');
//鉴权类
use Qiniu\Auth;
//上传类
use Qiniu\Storage\UploadManager;
/**
 * 七牛图片上传类
 * Class Upload
 * @package app\common\lib
 */
class Upload
{
    /**
     * image上传
     */
    public static function image()
    {
       // Vendor('Auth.Qiniu');
        if (empty($_FILES['file']['tmp_name'])) {
            exception('提交的图片数据不合法', 404);
        }
        //要上传的临时
        $file = $_FILES['file']['tmp_name'];

        $pathinfo = pathinfo($_FILES['file']['name']);
        /*  $ext = explode('.',$_FILES['file']['name']);
          $ext = [1];*/
        $ext = $pathinfo['extension'];

        $config = config('qiniu');
        //构建鉴权对象；

        $auth = new Auth($config['ak'], $config['sk']);
        //生成上传的token
        $token = $auth->uploadToken($config['bucket']);
        //上传到七牛后保存的文件名
        $key = date('Y') . '/' . date('m') . '/' . substr(md5($file), 0, 5) . date('YmdHis') . rand(0, 9999) . '.' . $ext;


        //初始化UploadManger类
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if ($err !== null) {
            return null;
        } else {
            return $key;
        }

    }

}