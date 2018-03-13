<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-02-03
 * Time: 13:06
 */
return [
    'password_pre_halt' => '_#sing_ty',//加密盐
    'aeskey' => 'sgg45747ss223455',
    'apptypes' => [
        'ios',
        'android',
    ],
    'app_sign_time' => 10,//sign失效时间 s
    'app_sign_cache_time'=>20,//sign缓存失效时间 s
];