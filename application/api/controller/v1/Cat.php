<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-13
 * Time: 12:57
 */

namespace app\api\controller\v1;
use app\api\controller\Common;

class Cat extends Common
{
    /**
     * 栏目接口
     */
    public function read()
    {
        $cats = config('cat.list');
        //halt($cats);
        $result[] = [
            'catid' => 0,
            'catname' => '首页'
        ];


        foreach ($cats as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                '$catname' => $catname,
            ];
        }
        return show(config('code.success'), 'ok', $result, 200);
    }

}