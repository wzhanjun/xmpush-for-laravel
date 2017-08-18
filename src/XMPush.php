<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/17
 * Time: 18:05
 */

namespace Wzj\Push;


use Wzj\Push\XMPush\AndroidBuilder;
use Wzj\Push\XMPush\IOSBuilder;
use Wzj\Push\XMPush\Message;
use Wzj\Push\XMPush\Sender;

/**
 * Class XMPush
 * @package Wzj\Push
 */
class XMPush extends Sender
{

    /**
     * @param string $type
     * @return AndroidBuilder|IOSBuilder
     */
    public function getMessage($type = Message::CLIENT_TYPE_ANDROID)
    {
        $this->setClient($type);

        switch ($type) {
            case Message::CLIENT_TYPE_IOS:
                return new IOSBuilder();
                break;
            default:
                return new AndroidBuilder();
        }
    }

    /**
     * 设置头信息
     *
     * @param $type
     */
    public function setClient($type = Message::CLIENT_TYPE_ANDROID)
    {
        switch ($type) {
            case Message::CLIENT_TYPE_IOS:
                $this->header = ['Authorization: key=' . config('xmpush.ios.app_secret'), 'Content-Type: application/x-www-form-urlencoded'];
                break;
            default:
                $this->header = ['Authorization: key=' . config('xmpush.android.app_secret'), 'Content-Type: application/x-www-form-urlencoded'];
        }
    }


}