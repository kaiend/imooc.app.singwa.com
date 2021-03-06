<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-04
 * Time: 9:54
 */

namespace app\admin\controller;

use think\Controller;

class News extends Base
{
    public function index()
    {
        //$this->model = '表名';//解决数据库和控制器表名不一样的问题
        //$news= model('News')->getNews();//模式一

        //模式二
//        page当前页 size每页显示的条数，from开始 limit from size
        $data = input('param.');
        $query = http_build_query($data);
        $whereData = [];
        //转换条件
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if (!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        if (!empty($data['title'])) {
            $whereData['title'] = ['like', '%' . $data['title'] . '%'];
        }
        $this->getPageAndSize($data);


        //获取表里面的数据
        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);
        //获取满足条件的总数=》共有多少页
        $total = model('News')->getNewsCountByCondition($whereData);
        //结合总数+size => 有多少页

        $pageTotal = ceil($total / $this->size);
        return $this->fetch('', [
            'cats' => config('cat.list'),
            'news' => $news,
            'pageTotal' => $pageTotal,
            'curr' => $this->page,
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'catid' => empty($data['catid']) ? '' : $data['catid'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'query' => $query,
        ]);
    }

    public function add()
    {
        if (request()->isPost()) {

            //return $this->result('',0,'添加失败');//测试失败的提示信息；
            $data = input('post.');
            //validate
            try {
                $id = model('News')->add($data);
            } catch (\Exception $e) {
                $this->result('', 0, '新增失败');
            }

            if ($id) {
                return $this->result(['jump_url' => url('news/index')], 1, '添加成功');
            } else {
                return $this->result('', 0, '添加失败');
            }
        } else {
            return $this->fetch('', [
                'cats' => config('cat.list')
            ]);
        };
    }


}