<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/

use think\Route;

Route::get('test', 'api/test/index');
Route::put('test/:id', 'api/test/update');
Route::delete('test/:id', 'api/test/delete');

Route::resource('test', 'api/test');
Route::get('api/:ver/cat', 'api/:ver.cat/read');//tp5自带版本控制方法吧v1赋值非ver，
Route::get('api/:ver/index','api/:ver.index/index');
Route::resource('api/:ver/news', 'api/:ver.news');
