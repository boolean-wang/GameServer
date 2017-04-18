<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "player_beasts".
 *
 * @property int $id
 * @property string $unique_code 唯一识别码
 * @property int $variation 变异类型 0(野生) 1(宝宝) 2(变异1) 3(变异2) 4(变异3) 5(变异4)
 * @property int $player_id 拥有者id
 * @property string $fight_level_panel 参战等级
 * @property int $level 等级
 * @property int $current_experience 当前经验
 * @property int $upgrade_experience 升级经验
 * @property int $hp 气血
 * @property int $mp 魔法
 * @property int $gj 攻击
 * @property int $fy 防御
 * @property int $sd 速度
 * @property int $ll 灵力
 * @property int $attack_point 力量点数
 * @property int $defence_point 耐力点数
 * @property int $physical_point 体质点数
 * @property int $magic_point 法力点数
 * @property int $speed_point 敏捷点数
 * @property int $potential 潜能点
 * @property string $type 召唤兽类型
 * @property int $attack_aptitude 攻击资质
 * @property int $defence_aptitude 防御资质
 * @property int $physical_aptitude 体力资质
 * @property int $magic_aptitude 法力资质
 * @property int $speed_aptitude 速度资质
 * @property int $dodge_aptitude 躲闪资质
 * @property int $skill_num 技能数量
 * @property string $skill 技能
 * @property double $growth 成长
 * @property int $life 寿命
 */
class PlayerBeasts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player_beasts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variation', 'player_id', 'level', 'current_experience', 'upgrade_experience', 'hp', 'mp', 'gj', 'fy', 'sd', 'll', 'attack_point', 'defence_point', 'physical_point', 'magic_point', 'speed_point', 'potential', 'attack_aptitude', 'defence_aptitude', 'physical_aptitude', 'magic_aptitude', 'speed_aptitude', 'dodge_aptitude', 'skill_num', 'life'], 'integer'],
            [['growth'], 'number'],
            [['unique_code', 'fight_level_panel', 'type', 'skill'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unique_code' => 'Unique Code',
            'variation' => 'Variation',
            'player_id' => 'Player ID',
            'fight_level_panel' => 'Fight Level Panel',
            'level' => 'Level',
            'current_experience' => 'Current Experience',
            'upgrade_experience' => 'Upgrade Experience',
            'hp' => 'Hp',
            'mp' => 'Mp',
            'gj' => 'Gj',
            'fy' => 'Fy',
            'sd' => 'Sd',
            'll' => 'Ll',
            'attack_point' => 'Attack Point',
            'defence_point' => 'Defence Point',
            'physical_point' => 'Physical Point',
            'magic_point' => 'Magic Point',
            'speed_point' => 'Speed Point',
            'potential' => 'Potential',
            'type' => 'Type',
            'attack_aptitude' => 'Attack Aptitude',
            'defence_aptitude' => 'Defence Aptitude',
            'physical_aptitude' => 'Physical Aptitude',
            'magic_aptitude' => 'Magic Aptitude',
            'speed_aptitude' => 'Speed Aptitude',
            'dodge_aptitude' => 'Dodge Aptitude',
            'skill_num' => 'Skill Num',
            'skill' => 'Skill',
            'growth' => 'Growth',
            'life' => 'Life',
        ];
    }
}
