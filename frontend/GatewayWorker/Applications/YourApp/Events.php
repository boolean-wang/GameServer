<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static $db = null;

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id) {
        // 向当前client_id发送数据 
        Gateway::sendToClient($client_id, json_encode(array(
            'type'      => 'init',
            'message' => '新用户登录', //还不能随便多个data数据??
            'client_id' => $client_id, //还不能随便多个data数据??
        )));
        // 向所有人发送 也可以在业务逻辑里面写
//        Gateway::sendToAll("$client_id login\n");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message) {
        // 向所有人发送 
        Gateway::sendToAll("$client_id said $message");
   }

    /**
     * @param $client_id
     * @throws Exception
     */
   public static function onClose($client_id) {
//       // 向所有人发送
//       $u_id = $_SESSION[$client_id];//不在一个代码里 不可能拿到session redis还凑合

       $redis = new Redis();
       $redis->connect('127.0.0.1', 6379);
       $u_id = $redis->get($client_id);

       Gateway::sendToAll(json_encode([
           'type' => 'logout',
           'message' => $client_id . '退出游戏',
           'client_id' => $client_id,
           'u_id' => $u_id,
       ]));

       //清理角色信息
       $x = $redis->get($u_id. ':x');//需要对数据库进行操作啊
       $y = $redis->get($u_id. ':y');

       self::updatePlayerLocation($u_id, $x, $y);


       $redis->del($client_id);
       $redis->del($u_id);
       $redis->del($u_id. ':x');//需要对数据库进行操作啊
       $redis->del($u_id. ':y');
       $redis->lRem('onlinePlayers',$u_id, 0);//删除列表
   }

   public static function updatePlayerLocation($player_id, $x, $y)
   {
       if(empty(self::$db)){
           self::$db = mysqli_connect('127.0.0.1', 'root', '', 'game_server', '3306');
           self::$db->set_charset("utf8");

       }

       $sql = "update player set x=$x, y=$y WHERE id=$player_id";
       $reslut = self::$db->query($sql);
   }
}
