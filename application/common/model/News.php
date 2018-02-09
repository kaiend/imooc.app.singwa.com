<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-08
 * Time: 15:50
 */

namespace app\common\model;

use think\Model;
class News extends Base
{
    /**
     * 获取后台列表
     * @return array
     */
    public function getNews($data=[])
    {
        $data['status'] = [
            'neq',config('code.status_delete')
        ];
        $order = ['id' =>  'desc'];
        $result =  $this -> where($data)
            ->order($order)
            ->paginate();
        return $result;
    }

}