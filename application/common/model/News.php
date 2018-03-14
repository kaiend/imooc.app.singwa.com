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
     * 后台自动化分页
     * @param array $data
     * @return \think\Paginator
     */
    public function getNews($data = [])
    {
        $data['status'] = [
            'neq', config('code.status_delete')
        ];
        $order = ['id' => 'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }

    /**
     * 根据条件来获取数据
     * @param array $param
     */
    public function getNewsByCondition($condition = [], $from = 0, $size = 5)
    {
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];

        $order = ['id' => 'desc'];
        $result = $this->where($condition)
            ->limit($from, $size)
            ->order($order)
            ->select();
        //echo $this->getLastSql();
        return $result;
    }

    /**
     * 根据条件获取列表数据的总数
     * @param array $param
     */
    public function getNewsCountByCondition($condition = [])
    {
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];
        return $this->where($condition)
            ->count();
    }

    /**
     * 获取首页头图
     * @param int $num
     * @return array
     */
    public function getIndexHeadNormalNews($num = 4)
    {
        $data = [
            'status' => 1,
            'is_head_figure' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }

    /**
     * 获取推荐的数据
     */
    public function getPositionNormalNews($num = 20)
    {
        $data = [
            'status' => 1,
            'is_position' => 1,

        ];
        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();

    }


    /**
     * 通用化获取参数的数据字段
     */
    public function _getListField()
    {
        return [
            'id',
            'catid',
            'image',
            'title',
            'read_count'];

    }

}