<?php

use yii\db\Migration;

class m170412_005128_create_player extends Migration
{
    public function safeUp()
    {
        $sql = "CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL COMMENT '账户id',
  `logout_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '退出时间',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '昵称',
  `sex` int(255) NOT NULL COMMENT '性别 (1男)  2(女)',
  `school` int(255) DEFAULT NULL COMMENT '门派',
  `role` int(255) DEFAULT NULL COMMENT '角色',
  `level` int(255) DEFAULT '0' COMMENT '人物等级',
  `current_experience` int(255) DEFAULT '0' COMMENT '当前经验',
  `upgrade_experience` int(255) DEFAULT NULL COMMENT '升级经验',
  `shang_hai` int(255) DEFAULT '0' COMMENT '伤害',
  `ming_zhong` int(255) DEFAULT '0' COMMENT '命中',
  `ling_li` int(255) DEFAULT '0' COMMENT '灵力',
  `fang_yu` int(255) DEFAULT '0' COMMENT '防御',
  `hp` int(255) DEFAULT '0' COMMENT '气血',
  `mp` int(255) DEFAULT '0' COMMENT '魔法',
  `sp` int(255) DEFAULT '0' COMMENT '愤怒',
  `speed` int(255) DEFAULT '0' COMMENT '速度',
  `fa_shang` int(255) DEFAULT '0' COMMENT '法伤',
  `fa_fang` int(255) DEFAULT '0' COMMENT '法防',
  `attack_point` int(255) DEFAULT '0' COMMENT '攻击点数',
  `defence_point` int(255) DEFAULT NULL COMMENT '防御点数',
  `physical_point` int(255) DEFAULT '0' COMMENT '体质点数',
  `magic_point` int(255) DEFAULT '0' COMMENT '魔法点数',
  `speed_point` int(255) DEFAULT '0' COMMENT '速度点数',
  `potential` int(255) DEFAULT '0' COMMENT '潜能点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;";
        $this->execute($sql);
    }

    public function safeDown()
    {
        echo "m170412_005128_create_player cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170412_005128_create_player cannot be reverted.\n";

        return false;
    }
    */
}
