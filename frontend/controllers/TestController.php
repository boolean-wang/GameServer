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
class TestController extends BaseController
{
    public function actionTest()
    {
        $userId = Yii::$app->user->id;
//        setcookie('unicode', 'dsds', time()+3000, '/');

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'Unicode',
            'value' => '2222',
            'expire' => time()+2200,
            'path' => '/'

        ]));

        var_dump($userId,Yii::$app->session);
    }
}