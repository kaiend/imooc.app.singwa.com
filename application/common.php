<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function pagination($obj)
{
    if (!$obj) {
        return '';
    }
    $params = request()->param();
    //return '<div class="imooc-app">' . $obj->appends($params)->render() . '</div>';
   // return '<div class="imooc-app">' . $obj->appends($params)->render() . '</div>';
}

/**
 * 获取栏目名称
 * @param $catId
 * @return string
 */
function getCatName($catId)
{
    if (!$catId) {
        return '';
    }
    $cats = config('cat.list');
    return !empty($cats[$catId]) ? $cats[$catId] : '';
}

function isYesNo($str)
{
    return $str ? '<span style="color: red">是</span>' : '<span>否</span>';
}

/**
 * 状态
 * @param $id
 * @param $status
 */
function status($id, $status)
{
    $controller = request()->controller();
    $sta = $status == 1 ? 0 : 1;
    $url = url($controller . '/status', ['id' => $id, 'status' => $sta]);
    if ($status == 1) {
        $str = "<a href='javascript:;' title='修改状态' status_url='" . $url . "' onclick='app_status(this)'><span 
class='label label-success rdiusa'>正
常</span></a>";
    } elseif ($status == 0) {
        $str = "<a href='javascript:;' title='修改状态' status_url='" . $url . "' onclick='app_status(this)'><span 
class='label label-success rdiusa'>待审</span></a>";
    }
    return $str;
}

/**
 * 通用化的API数据输出接口
 * @param $status
 * @param $message
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function show($status,$message,$data=[],$httpCode=200)
{
    $data=[
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return json($data,$httpCode);

}