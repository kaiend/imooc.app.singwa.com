<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-15
 * Time: 11:41
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\common\lib\exception\ApiException;

class Rank extends Common
{
    /**
     * 獲取排行榜數據列表
     * 1，獲取read_countpaixu  5-10
     * 2. youhua redis
     */
    public function index()
    {
        try {
            $rands = model('News')->getRankNormalNews();
            $rands = $this->getDealNews($rands);
        } catch (\Exception $e) {
            return new ApiException('error', 400);

        }
        return show(config('success'), 'ok', $rands, 200);

    }

}