<?php

use yii\db\Migration;

class m170416_133831_create_tbl_player_beasts extends Migration
{
    public function safeUp()
    {
        $sql = 'CREATE TABLE `player_beasts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT \'唯一识别码\',
  `variation` int(255) DEFAULT \'0\' COMMENT \'变异类型 0(野生) 1(宝宝) 2(变异1) 3(变异2) 4(变异3) 5(变异4)\',
  `player_id` int(255) NOT NULL DEFAULT \'0\' COMMENT \'拥有者id\',
  `fight_level_panel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT \'参战等级\',
  `level` int(255) DEFAULT NULL COMMENT \'等级\',
  `current_experience` int(255) DEFAULT \'0\' COMMENT \'当前经验\',
  `upgrade_experience` int(255) DEFAULT NULL COMMENT \'升级经验\',
  `hp` int(255) DEFAULT NULL COMMENT \'气血\',
  `mp` int(255) DEFAULT NULL COMMENT \'魔法\',
  `gj` int(255) DEFAULT NULL COMMENT \'攻击\',
  `fy` int(255) DEFAULT NULL COMMENT \'防御\',
  `sd` int(255) DEFAULT NULL COMMENT \'速度\',
  `ll` int(255) DEFAULT NULL COMMENT \'灵力\',
  `attack_point` int(255) DEFAULT NULL COMMENT \'力量点数\',
  `defence_point` int(255) DEFAULT NULL COMMENT \'耐力点数\',
  `physical_point` int(255) DEFAULT NULL COMMENT \'体质点数\',
  `magic_point` int(255) DEFAULT NULL COMMENT \'法力点数\',
  `speed_point` int(255) DEFAULT NULL COMMENT \'敏捷点数\',
  `potential` int(255) DEFAULT NULL COMMENT \'潜能点\',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT \'召唤兽类型\',
  `attack_aptitude` int(255) DEFAULT NULL COMMENT \'攻击资质\',
  `defence_aptitude` int(255) DEFAULT NULL COMMENT \'防御资质\',
  `physical_aptitude` int(255) DEFAULT NULL COMMENT \'体力资质\',
  `magic_aptitude` int(255) DEFAULT NULL COMMENT \'法力资质\',
  `speed_aptitude` int(255) DEFAULT NULL COMMENT \'速度资质\',
  `dodge_aptitude` int(255) DEFAULT NULL COMMENT \'躲闪资质\',
  `skill_num` int(255) DEFAULT NULL COMMENT \'技能数量\',
  `skill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT \'技能\',
  `growth` float DEFAULT NULL COMMENT \'成长\',
  `life` int(255) DEFAULT NULL COMMENT \'寿命\',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';

        $this->execute($sql);
    }

    public function safeDown()
    {
        echo "m170416_133831_create_tbl_player_beasts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170416_133831_create_tbl_player_beasts cannot be reverted.\n";

        return false;
    }
    */
}
