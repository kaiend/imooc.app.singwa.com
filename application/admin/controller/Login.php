<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/2
 * Time: 22:55
 */

namespace app\admin\controller;


use think\Controller;
use app\common\lib\IAuth;
class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 验证码验证+登录验证
     */
    public function check(){
        if ($this->request->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code'])){
                $this->error('验证码错误');
            }
            if(!$data['username']||!$data['password'])
            {
                $this->error('用户名或密码不能为空');
            }

            /**
             * model（AdminUser数据表）->get();
             */
            $user = model('AdminUser')->get(['username' => $data['username']]);
            if (!$user||$user->status !=1){
                $this->error('用户不存在');
            }

            //校验密码
               // md5($data['password'].'#sing_ty')
            if (IAuth::setpassword($data['password']) != $user['password']){
                $this->error('密码不正确');
            }
        }else{
            $this->error('请求不合法');
        }

    }


}