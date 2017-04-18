<?php
namespace frontend\controllers;

use common\models\User;
use frontend\behaviors\WorkmanBehavior;
use frontend\service\BaseService;
use Yii;
use yii\web\Controller;

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
        return empty($params) ? Yii::$app->request->get() : Yii::$app->request->get($params);
    }

    public function post($params = null)
    {
        return empty($params) ? Yii::$app->request->post() : Yii::$app->request->post($params);
    }

    public function JsonReturn($data)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * 进入角色后绑定用户
     */
    public function actionBind()
    {
        $uid = Yii::$app->user->id;
        $client_id = $this->post('client_id');
        // client_id与uid绑定
        $data = $this->bindUid($client_id, $uid);
        $this->JsonReturn($data);
    }

    /**
     * 新用户加入
     */
    public function actionJoin()
    {

    }
}