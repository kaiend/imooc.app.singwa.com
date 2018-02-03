<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/3
 * Time: 0:04
 */

namespace app\common\lib;

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
        return md5($data.config('app.password_pre_halt'));

    }

}