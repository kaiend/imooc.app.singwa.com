<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 23:44
 */

namespace app\common\model;


use think\Model;

class AdminUser extends Model
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