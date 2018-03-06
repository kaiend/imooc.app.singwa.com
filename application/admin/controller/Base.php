<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 22:26
 */

/**
 * 后台基础类库
 */

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    /**
     * page
     * @var string
     */
    public $page = '';
    /**
     * 每页显示条数
     * @var string
     */
    public $size = '';
    /**
     * 查询条件的开始值
     * @var int
     */
    public $from = 0;
    /**
     * model
     * @var string
     */
    public $model = '';

    /**
     * 初始化方法
     */
    public function _initialize()
    {
        $islogin = $this->islogin();
        if (!$islogin) {
            $this->redirect('login/index');
        }

    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function islogin()
    {
        $user = (session(config('admin.session_user'), '', config('admin.session_user_scope'))
        );//获取session
        if ($user && $user->id) {
            return true;
        }
        return false;

    }

    /**
     * 获取分页内容page and size
     */
    public function getPageAndSize($data)
    {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }

    /**
     * 删除逻辑
     */
    public function delete($id = 0)
    {
        //return $this->result('', 0, '删除失败');
        if (!intval($id)) {
            return $this->result('', 0, 'id不合法');
        }
        $model = $this->model ? $this->model : request()->controller();
        //php7的写法
        try {
            $res = model($model)->save(['status' => -1], ['id' => $id]);
        } catch (\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }
        if ($res) {
            // return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'ok');
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }
        if ($res) {
            return $this->result('', 0, '删除失败');
        }

    }

    /**
     * 通用化修改状态
     */
    public function status()
    {
        /* if (!intval($id)) {
             return $this->result('', 0, 'id不合法');
         }*/
        $data = input('param.');
        //todo tp5 validate校验

        //todo 通过id 查询记录是否存在
         $model = $this->model ? $this->model : request()->controller();

        // $i= model($model)->get($data['id']);

        try {
            $res = model($model)->save(['status' => $data['status']], ['id' => $data['id']]);
        } catch (\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }
        if ($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'ok');
        }
        if ($res) {
            return $this->result('', 0, '修改失败');
        }
    }


}