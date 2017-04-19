<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 1:50
 */
namespace frontend\controllers;
use common\models\Player;
use yii;
use frontend\service\BaseService;
class TestController extends BaseController
{
    public static $db = NUll;
    public function actionTest()
    {
        $players_arr = BaseService::playerList();
        $key = array_search('1002', $players_arr);
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
        var_dump($data);
    }
}