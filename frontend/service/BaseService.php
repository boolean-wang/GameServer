<?php
namespace frontend\service;

use common\models\Player;
use yii;

class BaseService
{
    const ONLINEUSERLIST = 'onlinePlayers';//workman 退出回调的地方也需要修改

    /**
     * @param $key
     * @param string $type
     * @return mixed
     */
    public static function getRedis($key, $type = 'json')
    {
        if ($type == 'array') {
            return json_decode(Yii::$app->redis->get($key), true);
        }
        return Yii::$app->redis->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function setRedis($key, $value)
    {
        //有一个强制下线吧
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return Yii::$app->redis->set($key, $value);
    }

    /**
     * 强制下线
     * @param $key
     * @return mixed
     */
    public static function delRedis($key)
    {
        return Yii::$app->redis->del($key);
    }

    /**
     * 获取玩家位置
     * @param $player_id
     * @return array
     */
    public static function getLocation($player_id)
    {
        //从数据库里面取出
        $x = self::getRedis($player_id.':x');
        $y  = self::getRedis($player_id.':y');

        return [$x, $y];
    }

    /**
     * 设置玩家位置
     * @param $player_id
     * @param $x
     * @param $y
     */
    public static function setLocation($player_id, $x, $y)
    {
        self::setRedis($player_id.':x', $x);
        self::setRedis($player_id.':y', $y);
    }

    /**
     * 删除玩家位置
     * @param $player_id
     */
    public static function delLocation($player_id)
    {
        //记录用户位置信息 存储到mysql
        $player = Player::find()->where(['id' => $player_id])->one();
        $player->x = self::getLocation($player_id)[0];
        $player->y = self::getLocation($player_id)[1];
        $player->save();
        //然后再删除
        self::delRedis($player_id.':x');
        self::delRedis($player_id.':y');

    }

    /**
     * 返回在线player_id
     * @return array [0=> '111', 1=> '222']
     */
    public static function playerList()
    {
        return Yii::$app->redis->executeCommand('lrange', [self::ONLINEUSERLIST, 0, self::playerListCount()]);
    }

    /**
     * @return mixed 在线用户人数统计
     */
    public static function playerListCount()
    {
        return Yii::$app->redis->executeCommand('llen', [self::ONLINEUSERLIST]);
    }

    /**
     * 玩家上线调用
     * @param $player_id
     * @return mixed
     */
    public static function playerListPush($player_id)
    {
        return Yii::$app->redis->executeCommand('rpush', [self::ONLINEUSERLIST, $player_id]);
    }

    /**
     * 玩家下线调用
     * @param $player_id
     * @return mixed
     */
    public static function playerListRem($player_id)
    {
        return Yii::$app->redis->executeCommand('lrem', [self::ONLINEUSERLIST, 0, $player_id]);
    }


    public static function getCookie($key)
    {
        return Yii::$app->request->cookies->get($key);
    }

    public static function setCookie($key)
    {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'user_token',
            'value' => md5($key),
            'expire' => time() + 3000,
            'path' => '/'
        ]));
        return md5($key);
    }

    public static function delCookie($key)
    {
        return Yii::$app->response->cookies->remove($key);
    }


    public static function setSession($key, $value)
    {
        Yii::$app->session->set($key, $value);
    }

    public static function getSession($key)

    {
        return Yii::$app->session->get($key);
    }
}