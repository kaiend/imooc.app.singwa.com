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
       //$news= model('News')->getNews();

        $data = input('param.');
        $whereData = [];
        $this->getPageAndSize($data);
        $whereData['page'] = $this->page;
        $whereData['size'] = $this->size;

        //获取表里面的数据
        $news= model('News')->getNewsByCondition($whereData);
        //获取满足条件的总数=》共有多少页
        $total = model('News')->getNewsByCondition($whereData);
        //结合总数+size => 有多少页
        $pageTotal = ceil($total/$whereData['size']);

        return $this->fetch('',[
            'news'=>$news,
            'pageTotal' =>$pageTotal,
            ]);
    }
    public function add()
    {
        if (request()->isPost()){

            //return $this->result('',0,'添加失败');//测试失败的提示信息；
            $data = input('post.');
            //validate
            try{
                $id=model('News')->add($data);
            }catch (\Exception $e){
                 $this->result('',0,'新增失败');
            }

            if ($id){

               return $this->result(['jump_url' => url('news/index')],1,'添加成功');
            }else{
                return $this->result('',0,'添加失败');
            }
        }else{
            return $this->fetch('',[
                'cats' => config('cat.list')
            ]);
        };
    }

}