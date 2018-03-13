<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-06
 * Time: 16:42
 */

namespace app\common\lib\exception;


use app\common\lib\exception\ApiException;
use think\exception\Handle;

class ApiHandleException extends Handle
{
    /**
     * http状态码
     * @var int
     */
    public $httpCode = 400;

    public function render(\Exception $e)
    {
        if (config('app_debug') == true) {
            return parent::render($e);
        }
        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
        }
        return show(0, $e->getMessage(), [], $this->httpCode);
    }

}