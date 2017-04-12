<?php
namespace frontend\controllers;
require_once '/mnt/shared/gameServer/frontend/GatewayWorker/vendor/workerman/GatewayClient-3.0.0/Gateway.php';
use Yii;
use yii\web\Controller;
use GatewayClient\Gateway;
/**
 * 基础类封装
 */
class BaseController extends Controller
{
    public $ignoreList = [];
    public function getIgnoreList()
    {
        return [
            'site/index',
            'site/login',
            'site/signup'
        ];
    }
//    /**
//     * 验证登录最简单的
//     * @param \yii\base\Action $action
//     * @return bool
//     */
//    public function beforeAction($action)
//    {
//
//        $path = Yii::$app->request->pathInfo;
//
//        if(in_array($path, $this->getIgnoreList())){
//            return true;
//        }
//
//        if(Yii::$app->user->isGuest){
//            return $this->redirect('/site/index');
//        }
//
//        return parent::beforeAction($action);
//    }

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
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值
        Gateway::$registerAddress = '127.0.0.1:1238';

//        // 假设用户已经登录，用户uid和群组id在session中
//        $uid      = $_SESSION['uid']; //从session中获取的用户id
        $uid      = 2000;
        $client_id = $this->post('client_id');
//        // client_id与uid绑定
        Gateway::bindUid($client_id, $uid);//绑定之后就可以直接通过uid进行发送数据了
//        // 加入某个群组（可调用多次加入多个群组）
//        Gateway::joinGroup($client_id, $group_id);
    }

    /**
     * 封装一个 workman 发送数据的方法
     */
    public function GatewayReturn($uid, $message)
    {
        Gateway::$registerAddress = '127.0.0.1:1238';
        // 向任意uid的网站页面发送数据
        $data = json_encode([
                'type' => 'message',
                'message' => $message
        ]);
        Gateway::sendToUid($uid, $data);
    }
}