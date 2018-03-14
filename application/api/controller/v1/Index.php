<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-13
 * Time: 15:27
 */

namespace app\api\controller\v1;


use app\api\controller\Common;

class Index extends Common
{
    /**
     * 获取首页接口数据
     * 1，头图 4-6条
     * 2，推荐为列表40条
     */
    public function index()
    {
        $heads = model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($heads);


        $positions = model('News')->getPositionNormalNews();
        $positions  =$this->getDealNews($positions);

        $result=[
            'heads'=>$heads,
            'posttions'=>$positions,
        ];

        return show(config('code.success'), 'ok', $result, 200);

    }

}