<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/18
 * Time: 10:17
 */

namespace Wzj\Push\XMPush;


class HttpBase
{
    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $header = [];

    /**
     * @var int
     */
    protected $timeout = 30;

    /**
     * @param string $url
     * @param array $data
     * @param int $retries  重复次数
     * @param array $header
     * @param int $timeout
     * @return string|Result
     */
    public function postResult($url = '', $data = [], $retries = 1, $header = [], $timeout = 30)
    {
        $result = new Result();

        for ($i =0; $i <= $retries; $i++) {
            $result->parseJson($this->request($url, $data, $header, 'post', $timeout));
            if ($result->getErrorCode() == ErrorCode::SUCCESS) {
                break;
            }
        }

        return $result;
    }

    /**
     * 发起请求
     *
     * @param string $url
     * @param array $data
     * @param array $header
     * @param string $method
     * @param int $timeout
     * @return mixed
     */
    public function request($url = '', $data = [], $header = [], $method = 'GET', $timeout = 30)
    {
        $header = empty($header) ? $this->header : $header;

        $ch = curl_init();
        //设置请求头
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //设置超时时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //设置返回内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //post提交
        if (strtolower($method) === 'post') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        } else {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data));
        }

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            //dd($error);
        }

        curl_close($ch);

        return $response;
    }

}