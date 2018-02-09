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
       $news= model('News')->getNews();
        return $this->fetch('',['news'=>$news]);
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