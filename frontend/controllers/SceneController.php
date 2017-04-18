<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 20:34
 */

namespace frontend\controllers;


use frontend\service\BaseService;

class SceneController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        $user_token = BaseService::getCookie('user_token')->value;
        var_dump($user_token);
    }

}