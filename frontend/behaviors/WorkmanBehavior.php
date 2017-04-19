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

    /**
     * 角色登录后进行绑定
     * @param $client_id
     * @param $uid  用户id
     * @return string
     */
    public function bindUid($client_id, $uid)
    {
        Gateway::bindUid($client_id, $uid);

        $userData = BaseService::getRedis($uid, 'array');

        //设置 $client_id, $uid  没有异步  有异步插件 to do
        BaseService::setRedis($client_id, $userData['player_id']);


        $exclude_client_id = Gateway::getClientIdByUid($uid);
        //向这个data添加一个 players 的数据
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
        $x = BaseService::getLocation($userId)[0];
        $y = BaseService::getLocation($userId)[1];
        $players = $this->getInlinePlayers($userId);

        $data = json_encode([
            'type' => 'notify_join',
            'message' => $userName . '加入游戏',
            'data' => [
                'player_Id' => $userId,
                'player_name' => $userName,
                'x' => $x,
                'y' => $y,
                'players' => $players

            ]
        ]);
        Gateway::sendToAll($data, null, $exclude_client_id);
        return $data;
    }

    /**
     * 获取所有在线玩家
     */
    public function getInlinePlayers($exclude_id)
    {
        $players_arr = BaseService::playerList();
        $key = array_search($exclude_id, $players_arr);
        array_splice($players_arr, $key, 1);
        $data = [];
        foreach ($players_arr as $player_id) {
            list($x, $y) = BaseService::getLocation($player_id);
            $data[] = [
                'player_Id' => $player_id,
                'player_name' => BaseService::getRedis($player_id, 'array')['id']['attr']['player_name'],
                'x' => $x,
                'y' => $y
            ];
        }
        return $data;
    }

    /**
     * @param $user_id
     * @param $player_id
     * @param $x
     * @param $y
     */
    public function updateLocation($user_id, $player_id, $x, $y)
    {


        $exclude_client_id = Gateway::getClientIdByUid($user_id);
        $data = json_encode([
            'type' => 'notify_move',
            'message' => $player_id . '移动位置',
            'data' => [
                'player_id' => $player_id,
                'x' => $x,
                'y' => $y
            ]
        ]);
        Gateway::sendToAll($data, null, $exclude_client_id);
    }
}