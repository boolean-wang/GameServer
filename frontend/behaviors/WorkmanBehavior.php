<?php
namespace frontend\behaviors;
require_once '/mnt/shared/gameServer/frontend/GatewayWorker/vendor/workerman/GatewayClient-3.0.0/Gateway.php';
use frontend\service\BaseService;
use yii\base\Behavior;
use GatewayClient\Gateway;
use yii\base\Exception;

class WorkmanBehavior extends Behavior
{
    public function __construct()
    {
        Gateway::$registerAddress = '127.0.0.1:1238';//注册地址
    }

    public function bindUid($client_id, $uid)
    {
        Gateway::bindUid($client_id, $uid);

        $userData = BaseService::getRedis($uid, 'array');

        //设置 $client_id, $uid  没有异步  有异步插件 to do
        BaseService::setRedis($client_id, $userData['player_id']);


        $exclude_client_id = Gateway::getClientIdByUid($uid);
        return $this->sendToAll($userData, $exclude_client_id);


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
     * 通知除自己外的用户
     * @param $userData
     * @param $exclude_client_id
     * @return string
     */
    public function sendToAll($userData, $exclude_client_id)
    {
        $userName = $userData['player_name'];
        $userId = $userData['player_id'];


        $data = json_encode([
            'type' => 'notify_join',
            'message' => $userName . '加入游戏',
            'data' => [
                'player_Id' => $userId,
                'player_name' => $userName
            ]
        ]);
        Gateway::sendToAll($data, null, $exclude_client_id);
        return $data;
    }
}