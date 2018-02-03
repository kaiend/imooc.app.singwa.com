<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 23:12
 */

namespace app\common\validate;


use think\Validate;

class AdminUser extends Validate
{
    protected $rule=[
      'username'=>'require|max:20',
      'password'=>  'require|max:20',
    ];

}