<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-12
 * Time: 16:46
 */

namespace app\common\lib;


class Time
{
    /**
     * 生成13位的时间戳
     */
    public static function get13TimeStamp()
    {
        list($t1, $t2) = explode(' ', microtime());
        //halt(microtime());
        return $t2 . ceil($t1 * 1000);
    }

}