<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/17
 * Time: 18:05
 */

return [
    //安卓密钥
    'android' => [
        'package_name' => '',
        'app_secret' => '',
    ],
    //ios密钥
    'ios' => [
        'package_name' => '',
        'app_secret'   => '',
    ],

    'urls' => [
        //向某个regid或一组regid列表推送某条消息（这些regId可以属于不同的包名）  https://sandbox.xmpush.xiaomi.com/v2/message/regid
        'reg_url' => 'https://api.xmpush.xiaomi.com/v3/message/regid',
        //向某个alias或一组alias列表推送某条消息（这些alias可以属于不同的包名）  https://sandbox.xmpush.xiaomi.com/v2/message/alias
        'alias_url' => 'https://api.xmpush.xiaomi.com/v3/message/alias',
        //向某个topic推送某条消息（可以指定一个或多个包名）                      https://sandbox.xmpush.xiaomi.com/v2/message/topic
        'topic_url' => 'https://api.xmpush.xiaomi.com/v3/message/topic',
        //向多个topic推送单条消息（可以指定一个或多个包名）
        'multi_topic_url' => 'https://api.xmpush.xiaomi.com/v3/message/multi_topic',
        //向所有设备推送某条消息（可以指定一个或多个包名）                       https://sandbox.xmpush.xiaomi.com/v2/message/all
        'all_url' => 'https://api.xmpush.xiaomi.com/v3/message/all',
        //检查定时推送任务
        'exist_url' => 'https://api.xmpush.xiaomi.com/v2/schedule_job/exist',
        //删除定时任务
        'delete_url' => 'https://api.xmpush.xiaomi.com/v2/schedule_job/delete',
    ],

    'retries' => 3,
];