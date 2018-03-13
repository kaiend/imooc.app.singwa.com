<?php
/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 2018-03-09
 * Time: 13:40
 */

namespace app\common\lib\exception;


use think\Exception;

class ApiException extends Exception
{
    public $message = '';
    public $httpCode = 600;
    public $code = 0;

    /**
     * ApiException constructor.
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($message = "", $httpCode = 0, $code = 0)
    {
        $this->message = $message;
        $this->httpCode = $httpCode;
        $this->code = $code;

    }

}