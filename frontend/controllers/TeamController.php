<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 20:34
 */

namespace frontend\controllers;
//use frontend\controllers\BaseController;//为啥可以不写成 frontend\controllers\BaseController; 在同一个命名空间下都可以不用引入
use frontend\service\TeamService;

class TeamController extends BaseController
{


    /**
     * 创建队伍
     */
    public function actionCreate()
    {
        //拿到参数登录用户的游戏角色
//        $get = $this->get('ds');
        $id = $this->get('id');
        $teamSn = TeamService::getTeam($id);//返回的是一个Team编号
        //这个倒是不用workman 直接返回$teamSn就行
        $data = [
                'code' => '200',
                'msg' => 'success',
                'data' => [
                    'type' => 'createTeam',
                    'teamSn' => $teamSn
                ]
        ];
        return $this->JsonReturn($data);

    }

    /**
     * 申请组队
     */
    public function actionApply()
    {
        //参数一 队伍编号, 队员id
        //业务逻辑就交给 TeamService::getApply($队伍编号, $队员id);
        //这个业务逻辑其实就是 在 redis 里面退伍编号的那个地方append 这个队员id
        //这里需要workman进行通知了 Workman::notify($id, $type, $data )  $data就是队伍编号
    }

    /**
     * 确认组队
     */
    public function actionConfirm()
    {
        //参数: $teamSn, [$id=>$operateSecret]
    }
}