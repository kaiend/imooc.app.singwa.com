<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-14
 * Time: 11:02
 */

namespace app\api\controller\v1;


use app\api\controller\Common;

class News extends Common
{
    public function index()
    {
        $data = input('get.');
        //validate 验证
        $whereData['status'] = config('code.status_normal');
        if (!empty($data['catid'])) {
            $whereData['catid'] = input('get.catid', 0, 'intval');

        }

        if (!empty($data['title'])) {
            $whereData['title'] = ['like', '%' . $data['title'] . '%'];
        }

        $this->getPageAndSize($data);
        $total = model('News')->getNewsCountByCondition($whereData);
        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);
        $result = [
            'total' => $total,
            'page_num' => ceil($total / $this->size),
            'list' => $this->getDealNews($news)
        ];
        return show(config('code.success'), 'ok', $result, 200);
    }

}