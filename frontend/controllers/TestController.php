<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 1:50
 */
namespace frontend\controllers;
class TestController extends BaseController
{
    public function actionTest()
    {
        $id = $this->get('id');
        $this->sendToUid($id,'message', 'welcome:' . $id);
    }
}