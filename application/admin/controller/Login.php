<?php
/**
 * Created by PhpStorm.
 * User: kaiend
 * Date: 2018/2/2
 * Time: 22:55
 */

namespace app\admin\controller;
use app\common\lib\IAuth;
class Login extends Base
{
    public function _initialize(){

    }

    /**
     * 判断登录
     * @return mixed|void
     */
    public function index()
    {
        $islogin = $this->islogin();
        if ($islogin){
            return $this ->redirect('index/index');
        }else{
            return $this->fetch();
        }
    }

    /**
     * login 相关
     * 验证码验证+登录验证
     */
    public function check(){
        if (request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code'])){
                $this->error('验证码错误');
            }
            if(!$data['username']||!$data['password'])
            {
                $this->error('用户名或密码不能为空');
            }

            try {
                $user = model('AdminUser')->get(['username' => $data['username']]);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if (!$user || $user->status != config('code.status_normal')) {
                $this->error('用户不存在');
            };

            if (IAuth::setPassword($data['password']) != $user['password']) {
                $this->error('密码错误');
            }

            $udata = [
                'last_login_time' => time(),
                'last_login_ip' => request()->ip(),
            ];
            try {
                model('AdminUser')->save($udata, ['id' => $user->id]);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            //2session保存
            session(config('admin.session_user'),$user,config('admin.session_user_scope'));
            $this->success('登陆成功','index/index');
        }else{
            $this->error('请求不合法');
        }

    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session(null,config('admin.session_user_scope'));
        $this->redirect('login/index');
    }


}