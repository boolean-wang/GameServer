<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 10:58
 */
namespace frontend\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Controller;
use yii\helpers\Url;
class LoginBehavior extends Behavior
{
    public $allowActions = [];
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'loginAction',
        ];
    }

    public function loginAction($event)
    {
//        $event->isValid = true; // 继续执行action
        $action = $event->action;
        $rule = $action->getUniqueId();

        foreach ($this->allowActions as $allow) {
            //dump($rule); dump(rtrim($allow,'*')); echo '<br>';
            if (substr($allow, -1) == '*') {
                if (strpos($rule, rtrim($allow,'*')) === 0) {
                    return true;
                }
            } else {
                if ($rule == $allow) {
                    return true;//return true了 为什么还会执行到下面???
                }
            }
        }
        /**
         * 登录检查
         */
        if(Yii::$app->user->isGuest){
            //base/bind 捣乱了 权限认证 跳转到首页  首页又ajax自动加载  base/bind 权限认证又不行了
            Yii::$app->user->loginRequired(); //卧槽 这个方法对着
            return Yii::$app->getResponse()->redirect(Url::to('/site/index'));//不能加return了
//            return Yii::$app->getResponse()->redirect(Url::to('/site/index'));

        }else{
            return true;
        }
//        $event->isValid = false;
    }
}