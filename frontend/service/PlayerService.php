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

class PlayerService extends BaseService
{
    public static $flag = false;
    public static $id;
    public static $userId;
    /**
     * @param $id
     * @return string
     */
    public static function getInit($id, $userId)
    {



//        if(BaseService::getRedis($id)){
//            return ['data' => BaseService::getRedis($id), 'msg' => '断线重连成功'];
//        }

        //清除历史角色
        self::clearHistroyPlayer($userId);

        //这个要几个的连表吧 连表反而是不好了 不能区分
        $pack = array_map(function($res){
            return $res->attributes;
        }, PlayerPack::findAll(['u_id' => $id]));
        $beasts = PlayerBeasts::findOne(['player_id' => $id, 'is_use' => 1]);

        $attr = Player::findOne(['id' => $id]);

        $attr_data = empty($attr) ? [] : array(
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

        $user_token = BaseService::setCookie($id);

        if(self::$flag = true){
            $msg = '清除历史用户，初始化成功';
        }else{
            $msg = '初始化用户成功';
        }

        //redis 设置 user_id => ['user_token', 'player_id']
        $configData = ['player_id' => $id, 'player_name' => $attr->nickname, 'user_token' => $user_token];
        BaseService::setRedis($userId, $configData);

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


}