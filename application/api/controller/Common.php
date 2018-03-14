<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-09
 * Time: 16:38
 */

namespace app\api\controller;


use app\common\lib\exception\ApiException;
use app\common\lib\Time;
use think\Controller;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use think\Cache;

/**
 * Api模块公共的控制器
 * Class Common
 * @package app\api\controller
 */
class Common extends Controller
{
    /**header头
     * @var string
     */
    public $headers = '';

    /**
     * 初始化的方法
     */
    public function _initialize()
    {
        $this->checkRequestAuth();
        $this->testAes();
    }

    /**
     * 检查app请求的数据是否合法
     */
    public function checkRequestAuth()
    {
        //获取headers数据
        $headers = request()->header();
        //halt($headers);
        //基础校验
        if (empty($headers['sign'])) {
            throw new ApiException('sign不存在', 400);
        }
        if (!in_array($headers['apptype'], config('app.apptypes'))) {
            throw new ApiException('apptype类型不合法', 400);
        }

        //sign
        if (!IAuth::checkSignPass($headers)) {
            throw new ApiException('授权码sign失败', 401);
        }
        Cache::set($headers['sign'], 1, config('app.app_sign_cache_time'));
        $this->headers = $headers;


    }

    public function testAes()
    {
        //echo '1';exit;
        $data = [
            'did' => '123456dg',
            'version' => 1,
            'time' => Time::get13TimeStamp(),
        ];
        // halt($data);

        //echo IAuth::setSign($data);exit;//加密


        /* $strrr = "FMyCkGsFlHaWfM6HOaFoh7qe5YPbBfuhlYBcB6GCr4g=";
         echo (new Aes())->decrypt($strrr);
         exit;//解密*/


    }

    /**
     * 获取处理的新闻内容的数据
     * @param array $news
     * @return array
     */
    protected function getDealNews($news = [])
    {
        if (empty($news)) {
            return [];
        }
        $cats = config('cat.list');
        foreach ($news as $key => $new) {
            $news[$key]['catname'] = $cats[$new['catid']] ? $cats[$new['catid']] : '-';
            return $news;
        }


    }


}