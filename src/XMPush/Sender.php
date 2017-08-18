<?php
/**
 * Created by PhpStorm.
 * User: NHXuan
 * Date: 2017/8/18
 * Time: 11:10
 */

namespace Wzj\Push\XMPush;


class Sender extends HttpBase
{

    /**
     * 指定regId单发消息
     *
     * @param Message $message
     * @param $regId
     * @param int $retries
     * @return string|Result
     */
    public function send(Message $message, $regId, $retries = 1)
    {
        $fields = $message->getFields();
        $fields['registration_id'] = $regId;

        return $this->postResult(config('xmpush.urls.reg_url'), $fields, $retries);
    }

    /**
     * 指定regId列表群发
     *
     * @param Message $message
     * @param array $regIds
     * @param int $retries
     * @return string|Result
     */
    public function sendToIds(Message $message, $regIds = [], $retries = 1)
    {
        $fields = $message->getFields();
        $fields['registration_id'] = implode(Message::PACKAGE_NAME_SPLIT, $regIds);

        return $this->postResult(config('xmpush.urls.reg_url'), $fields, $retries);
    }

    /**
     * 指定别买发送
     *
     * @param Message $message
     * @param $alias
     * @param int $retries
     * @return string|Result
     */
    public function sendToAlias(Message $message, $alias, $retries = 1)
    {
        $fields = $message->getFields();
        $fields['alias'] = $alias;

        return $this->postResult(config('xmpush.urls.alias_url'), $fields, $retries);
    }

    /**
     * 指定别名列表群发
     *
     * @param Message $message
     * @param $aliasList
     * @param int $retries
     * @return string|Result
     */
    public function sendToAliases(Message $message, $aliasList, $retries = 1)
    {
        $fields = $message->getFields();
        $fields['alias'] = implode(Message::PACKAGE_NAME_SPLIT, $aliasList);

        return $this->postResult(config('xmpush.urls.alias_url'), $fields, $retries);
    }


    /**
     * 指定topic群发
     *
     * @param Message $message
     * @param $topic
     * @param int $retries
     * @return string|Result
     */
    public function broadcast(Message $message, $topic, $retries = 1) {
        $fields = $message->getFields();
        $fields['topic'] = $topic;
        return $this->postResult(config('xmpush.urls.topic_url'), $fields, $retries);
    }

    /**
     * 广播消息，多个topic，支持topic间的交集、并集或差集
     *
     * @param Message $message
     * @param $topicList
     * @param $topicOp
     * @param int $retries
     * @return string|Result
     */
    public function multiTopicBroadcast(Message $message, $topicList, $topicOp, $retries = 1) {
        if (count($topicList) == 1) {
            return $this->broadcast($message, $topicList[0], $retries);
        }
        $fields = $message->getFields();
        $fields['topics'] = implode(Message::MULTI_TOPIC_SPLIT, $topicList);
        $fields['topic_op'] = $topicOp;
        return $this->postResult(config('xmpush.urls.multi_topic_url'), $fields, $retries);
    }


    /**
     * 向所有设备发送消息
     *
     * @param Message $message
     * @param int $retries
     * @return string|Result
     */
    public function broadcastAll(Message $message, $retries = 1) {
        $fields = $message->getFields();
        return $this->postResult(config('xmpush.urls.all_url'), $fields, $retries);
    }

    /**
     * 检测定时任务是否存在
     *
     * @param $msgId
     * @param int $retries
     * @return string|Result
     */
    public function checkScheduleJobExist($msgId, $retries = 1) {
        $fields = array('job_id' => $msgId);
        return $this->postResult(config('xmpush.urls.exist_url'), $fields, $retries);
    }

    /**
     * 删除定时任务
     *
     * @param $msgId
     * @param int $retries
     * @return string|Result
     */
    public function deleteScheduleJob($msgId, $retries = 1) {
        $fields = array('job_id' => $msgId);
        return $this->postResult(config('xmpush.urls.delete_url'), $fields, $retries);
    }

}