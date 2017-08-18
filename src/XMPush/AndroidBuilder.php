<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/17
 * Time: 18:12
 */

namespace Wzj\Push\XMPush;


class AndroidBuilder extends Message
{

    const SOUND_URL             = 'sound_uri';
    const NOTIFY_FOREGROUND     = 'notify_foreground';   //应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
    const NOTIFY_EFFECT         = 'notify_effect';
    const INTENT_URI            = 'intent_uri';
    const WEB_URI               = 'web_uri';
    const FLOW_CONTROL          = 'flow_control';
    const CALLBACK              = 'callback';

    public function __construct()
    {
        $this->notify_id = 0;
        $this->notify_type = -1;
        $this->payload     = '';
        $this->restricted_package_name = '';

        parent::__construct();
    }

    /**
     * 这是一条通知栏消息，
     *
     * @param $payload
     */
    public function payload($payload) {
        $this->payload = $payload;
    }

    /**
     * 标题
     *
     * @param $title
     */
    public function title($title) {
        $this->title = $title;
    }

    /**
     * 描述
     *
     * @param $description
     */
    public function description($description) {
        $this->description = $description;
    }

    /**
     * 0 表示通知栏消息1 表示透传消息
     * 如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
     * @param $passThrough
     */
    public function passThrough($passThrough) {
        $this->pass_through = $passThrough;
    }

    /**
     * 通知类型
     *
     * @param $type
     */
    public function notifyType($type) {
        $this->notify_type = $type;
    }

    public function restrictedPackageNames($packageNameList) {
        $jointPackageNames = '';
        foreach ($packageNameList as $packageName) {
            if (isset($packageName)) {
                $jointPackageNames .= $packageName . config('package_name_split', self::PACKAGE_NAME_SPLIT);
            }
        }
        $this->restricted_package_name = $jointPackageNames;
    }

    /**
     * 如果用户离线，设置消息在服务器保存的时间，单位：ms。服务器默认最长保留两周。
     *
     * @param $ttl
     */
    public function timeToLive($ttl) {
        $this->time_to_live = $ttl;
    }

    /**
     * 定时发送消息。用自1970年1月1日以来00:00:00.0 UTC时间表示（以毫秒为单位的时间）。
     *
     * 仅支持七天内的定时消息。
     *
     * @param $timeToSend
     */
    public function timeToSend($timeToSend) {
        $this->time_to_send = $timeToSend;
    }

    /**
     * // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
     *
     * @param $notifyId
     */
    public function notifyId($notifyId) {
        $this->notify_id = $notifyId;
    }

    /**
     * 额外字段
     *
     * @param $key
     * @param $value
     */
    public function extra($key, $value) {
        $this->extra[$key] = $value;
    }

    public function build() {
        $keys = array(
            'payload', 'title', 'description', 'pass_through', 'notify_type',
            'restricted_package_name', 'time_to_live', 'time_to_send', 'notify_id'
        );
        foreach ($keys as $key) {
            if (isset($this->$key)) {
                $this->fields[$key] = $this->$key;
                $this->json_infos[$key] = $this->$key;
            }
        }

        //单独处理extra
        $JsonExtra = array();
        if (count($this->extra) > 0) {
            foreach ($this->extra as $extraKey => $extraValue) {
                $this->fields[Message::EXTRA_PREFIX . $extraKey] = $extraValue;
                $JsonExtra[$extraKey] = $extraValue;
            }
        }
        $this->json_infos['extra'] = $JsonExtra;

    }

}