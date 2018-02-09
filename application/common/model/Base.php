<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-08
 * Time: 15:47
 */

namespace app\common\model;


use think\Model;

class Base extends Model
{

    /**
     * 自动写入时间
     */
    protected $autoWriteTimestamp = true;

    /**
     * 新增
     * @param $data
     * @return mixed
     *
     */
    public function add($data)
    {
        if (!is_array($data)){
            exception('提交的数据不合法');
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

}