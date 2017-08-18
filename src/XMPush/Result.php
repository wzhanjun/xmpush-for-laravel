<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/18
 * Time: 10:34
 */

namespace Wzj\Push\XMPush;


class Result
{

    /**
     * @var Error code
     */
    private $errorCode;
    /**
     * @var Data raw
     */
    private $raw;

    /*
    public function __construct($jsonStr){


    }
    */

    public function parseJson($json)
    {
        $data = json_decode($json, true);
        $this->raw = $data;
        $this->errorCode = $data['code'];
    }

    /**
     * HttpBase getErrorCode.
     * @return  String
     */
    public function getErrorCode(){
        return $this->errorCode;
    }

    /**
     * HttpBase getRaw.
     * @return  Array
     */
    public function getRaw(){
        return $this->raw;
    }

}