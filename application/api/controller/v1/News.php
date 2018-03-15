<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-14
 * Time: 11:02
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\common\lib\exception\ApiException;

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

    /**
     * 獲取詳情頁接口
     */
    public function read()
    {
        //詳情頁面 app-》 1，x.com/
        $id = input('param.id', 0, 'intval');
        if (empty($id)) {
            return new ApiException('ID IS NOT', 404);
        }

        //通過id獲取數據
        $news = model('News')->get($id);
        if (empty($news) || $news->status != config('code.status_normal')) {
            return new ApiException('不存在改新聞', 404);
        }

        //閱讀數自動加1
        try {
            model('News')->where(['id' => $id])->setInc('read_count');

        } catch (\Exception $e) {
            return new ApiException('ERROR不存在的新聞', 400);
        }

        $cats = config('cat.list');//獲取欄目名稱
        $news->catname = $cats[$news->catid];//獲取欄目名稱
        return show(config('code.success'), 'ok', $news, 200);

    }

}