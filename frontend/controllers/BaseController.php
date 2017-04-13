<?php
namespace frontend\controllers;
use frontend\behaviors\WorkmanBehavior;
use Yii;
use yii\web\Controller;
use GatewayClient\Gateway;
/**
 * 基础类封装
 */
class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'workmanBehaviors' => WorkmanBehavior::className()
        ];
    }

    public function get($params = null)
    {
        return empty($params) ? Yii::$app->request->get() :Yii::$app->request->get($params);
    }

    public function post($params = null)
    {
        return empty($params) ? Yii::$app->request->post() :Yii::$app->request->post($params);
    }

    public function JsonReturn($data)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }


    public function actionBind()
    {
        $uid = Yii::$app->user->id;
        $client_id = $this->post('client_id');
//        // client_id与uid绑定
        $this->bindUid($client_id, $uid);
//        Gateway::joinGroup($client_id, $group_id);
    }
}