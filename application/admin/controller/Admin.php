<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/1
 * Time: 23:00
 */

namespace app\admin\controller;


use think\Controller;
use app\common\lib\IAuth;

class Admin extends Controller
{
    public function add()
    {
        if (request()->isPost()){
           // halt(input('post.'));
            $data = input('post.');
            $validate = validate('AdminUser');
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
           // $data['password']=md5($data['password'].'_#sing_ty');
            $data['password']=IAuth::setpassword($data['password']);
            $data['status']=1;

            try{
               $id= model('AdminUser')->add($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            if ($id){
                $this->success('id='.$id.'的用户新增成功');
            }else{
                $this->error('error');
            }
        }else{
            return $this->fetch();
        }
        //return $this->fetch();
    }

}