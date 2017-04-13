<?php
namespace frontend\behaviors;
require_once '/mnt/shared/gameServer/frontend/GatewayWorker/vendor/workerman/GatewayClient-3.0.0/Gateway.php';
use yii\base\Behavior;
use GatewayClient\Gateway;

class WorkmanBehavior extends Behavior
{
    public function __construct()
    {
        Gateway::$registerAddress = '127.0.0.1:1238';//注册地址
    }

    public function bindUid($client_id, $uid)
    {
        Gateway::bindUid($client_id, $uid);
    }

    /**
     * 向指定用户发送指定类型的数据
     * @param $uid
     * @param $type
     * @param $message
     */
    public function sendToUid($uid, $type, $message)
    {
        $data = json_encode([
            'type' => $type,
            'message' => $message
        ]);
        Gateway::sendToUid($uid, $data);
    }

    /**
     * 获取所有在线用户的 client_id
     * @return array
     */
    public function getALLClientInfo()
    {
        return Gateway::getALLClientInfo();
    }
}