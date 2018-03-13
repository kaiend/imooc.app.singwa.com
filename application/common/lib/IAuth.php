<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/3
 * Time: 0:04
 */

namespace app\common\lib;

use app\common\lib\Aes;
use think\Cache;

/**
 * Class IAuth
 * @package app\common\lib
 */
class IAuth
{
    /**
     * 设置密码
     * @param $data
     * @return string
     */
    public static function setPassword($data)
    {
        return md5($data . config('app.password_pre_halt'));

    }

    /**
     * 生成每次请求的sign
     * @param array $data
     * @return HexString|string
     */
    public static function setSign($data = [])
    {
        //按照字段排徐
        ksort($data);

        //2拼接数据 &
        $string = http_build_query($data);
        //3通过aes加密
        $string = (new Aes())->encrypt($string);
        //4转换为大写
        //$string = strtoupper($string);
        return $string;
    }

    /**
     * 检查SIGN是否正常
     * @param $data
     * @return bool
     */
    public static function checkSignPass($data)
    {
        $str = (new Aes())->decrypt($data['sign']);
        //halt($data);
        if (empty($str)) {
            return false;
        }
        parse_str($str, $arr);//
        // halt($arr);
        if (!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did']) {
            return false;
        }
        if (!config('app_debug')) {
            if ((time() - ceil($arr['time']) / 1000) > config('app.app_sign_time')) {
                return false;
            }
//echo Cache::get($data['sign']);exit;
            //唯一性判定 获取缓存里面的sign
            if (Cache::get($data['sign'])) {
                return false;
            }
        }


        return true;

    }

}