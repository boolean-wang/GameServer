<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 20:42
 */
namespace frontend\service;
use common\models\Player;
use common\models\PlayerBeasts;
use common\models\PlayerPack;
use frontend\behaviors\WorkmanBehavior;

class PlayerService extends BaseService
{
    public static $flag = false;
    public static $id;
    public static $userId;

    /**
     * @param $id  游戏角色id
     * @param $userId  用户id
     * @return array
     */
    public static function getInit($id, $userId)
    {

        //清除历史角色
        self::clearHistroyPlayer($userId);

        //这个要几个的连表吧 连表反而是不好了 不能区分
        $pack = array_map(function($res){
            return $res->attributes;
        }, PlayerPack::findAll(['u_id' => $id])); //背包
        $beasts = PlayerBeasts::findOne(['player_id' => $id, 'is_use' => 1]); //召唤兽

        $attr = Player::findOne(['id' => $id]); //角色属性

        $attr_data = empty($attr) ? [] : array(
            'player_name' => $attr->nickname,
            'shang_hai' => $attr->shang_hai,
            'fang_yu' => $attr->fang_yu,
            'speed' => $attr->speed,
        );

        $beasts_data = empty($beasts) ? [] : array(
            'shang_hai' => $beasts->gj,
            'fang_yu' => $beasts->fy,
            'speed' => $beasts->sd,
        );

        $data = array(
            'id' => array(
                'attr' => $attr_data,
                'beasts' => $beasts_data,
                'pack' => $pack
            )
        );
        //============================================================================
        //进行 redis session cookie 的设置
        //============================================================================
        $user_token = BaseService::setCookie($id);

        if(self::$flag = true){
            $msg = '清除历史用户，初始化成功';
        }else{
            $msg = '初始化用户成功';
        }

        // 设置角色、用户关系   redis 设置 user_id => ['user_token', 'player_id']
        $configData = ['player_id' => $id, 'player_name' => $attr->nickname, 'user_token' => $user_token];
        BaseService::setRedis($userId, $configData);
        // 设置登录列表
        BaseService::playerListPush($id);
        // 设置位置 从数据库里面取的
        BaseService::setLocation($id, $attr->x, $attr->y);

        return  ['data' => BaseService::setRedis($id, $data), 'msg' => $msg];



    }

    public function clearHistroyPlayer($userId)
    {
        //获取该用户的所有角色
        $players = Player::findAll(['u_id' => $userId]);
        foreach ($players as $player){
            if(BaseService::getRedis($player->id)){
                BaseService::delRedis($player->id);//删除 redis
                BaseService::delCookie($player->id);//删除 cookie
                BaseService::playerListRem($player->id);//清除登录列表
                BaseService::delLocation($player->id);
                self::$flag = true;
            }
        }
    }


    /**
     * 返回用户详细信息
     */

    public static function getPlayerDetail($user_id)
    {
        //根据用户id查找当前登录的 角色
        $player_config = BaseService::getRedis($user_id);
        $player_id = json_decode($player_config)->player_id;
        $player_data = BaseService::getRedis($player_id);
        return $player_data;
    }


    /**
     * 角色位置移动  没有返回值
     * @param $user_id
     * @param $x
     * @param $y
     */
    public static function setPlayerLocation($user_id, $x, $y)
    {
        //根据用户id查找当前登录的 角色
        $player_config = BaseService::getRedis($user_id);
        $player_id = json_decode($player_config)->player_id;
        //进行位置设置 并且进行通知  还是使用 1000:x => 100, 1000:y => 300这种形式吧 因为经常要变得
        BaseService::setRedis($player_id.':x', $x);
        BaseService::setRedis($player_id.':y', $y);
        //通知其它玩家
        $workman = new WorkmanBehavior();
        $workman->updateLocation($user_id, $player_id, $x, $y);

    }

}