<?php
namespace frontend\service;

use yii;

class BaseService
{

    /**
     * @param $key
     * @param string $type
     * @return mixed
     */
    public static function getRedis($key, $type = 'json')
    {
        if ($type == 'array') {
            return json_decode(Yii::$app->redis->get($key), true);
        }
        return Yii::$app->redis->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function setRedis($key, $value)
    {
        //有一个强制下线吧
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return Yii::$app->redis->set($key, $value);
    }

    /**
     * 强制下线
     * @param $key
     * @return mixed
     */
    public static function delRedis($key)
    {
        return Yii::$app->redis->del($key);
    }

    public static function getCookie($key)
    {
        return Yii::$app->request->cookies->get($key);
    }

    public static function setCookie($key)
    {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'user_token',
            'value' => md5($key),
            'expire' => time() + 3000,
            'path' => '/'
        ]));
        return md5($key);
    }

    public static function delCookie($key)
    {
        return Yii::$app->response->cookies->remove($key);
    }


    public static function setSession($key, $value)
    {
        Yii::$app->session->set($key, $value);
    }

    public static function getSession($key)
    {
        return Yii::$app->session->get($key);
    }
}