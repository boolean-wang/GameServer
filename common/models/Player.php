<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property int $u_id 账户id
 * @property string $logout_time 退出时间
 * @property string $nickname 昵称
 * @property int $sex 性别 (1男)  2(女)
 * @property int $school 门派
 * @property int $role 角色
 * @property int $level 人物等级
 * @property int $current_experience 当前经验
 * @property int $upgrade_experience 升级经验
 * @property int $shang_hai 伤害
 * @property int $ming_zhong 命中
 * @property int $ling_li 灵力
 * @property int $fang_yu 防御
 * @property int $hp 气血
 * @property int $mp 魔法
 * @property int $sp 愤怒
 * @property int $speed 速度
 * @property int $fa_shang 法伤
 * @property int $fa_fang 法防
 * @property int $attack_point 攻击点数
 * @property int $defence_point 防御点数
 * @property int $physical_point 体质点数
 * @property int $magic_point 魔法点数
 * @property int $speed_point 速度点数
 * @property int $potential 潜能点
 * @property string $x x
 * @property string $y y
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'nickname', 'sex'], 'required'],
            [['u_id', 'sex', 'school', 'role', 'level', 'current_experience', 'upgrade_experience', 'shang_hai', 'ming_zhong', 'ling_li', 'fang_yu', 'hp', 'mp', 'sp', 'speed', 'fa_shang', 'fa_fang', 'attack_point', 'defence_point', 'physical_point', 'magic_point', 'speed_point', 'potential'], 'integer'],
            [['logout_time', 'nickname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => 'U ID',
            'logout_time' => 'Logout Time',
            'nickname' => 'Nickname',
            'sex' => 'Sex',
            'school' => 'School',
            'role' => 'Role',
            'level' => 'Level',
            'current_experience' => 'Current Experience',
            'upgrade_experience' => 'Upgrade Experience',
            'shang_hai' => 'Shang Hai',
            'ming_zhong' => 'Ming Zhong',
            'ling_li' => 'Ling Li',
            'fang_yu' => 'Fang Yu',
            'hp' => 'Hp',
            'mp' => 'Mp',
            'sp' => 'Sp',
            'speed' => 'Speed',
            'fa_shang' => 'Fa Shang',
            'fa_fang' => 'Fa Fang',
            'attack_point' => 'Attack Point',
            'defence_point' => 'Defence Point',
            'physical_point' => 'Physical Point',
            'magic_point' => 'Magic Point',
            'speed_point' => 'Speed Point',
            'potential' => 'Potential',
        ];
    }
}
