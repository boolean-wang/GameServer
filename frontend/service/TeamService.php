<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 20:42
 */
namespace frontend\service;
class TeamService
{
    /**
     * 提供的都是静态方法
     */
    public static function getTeam($id)
    {
        return md5($id);
    }
}