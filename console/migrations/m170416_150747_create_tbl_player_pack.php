<?php

use yii\db\Migration;

class m170416_150747_create_tbl_player_pack extends Migration
{
    public function safeUp()
    {
        $sql = 'CREATE TABLE `player_pack` (
`id`  int NOT NULL ,
`u_id`  int NOT NULL ,
`name`  varchar(255) NOT NULL COMMENT \'物品名称\' ,
`num`  int NULL COMMENT \'数量\' ,
`attr`  varchar(255) NULL COMMENT \'物品属性 json\' ,
PRIMARY KEY (`id`),
INDEX `u_id` (`u_id`) 
)';
        $this->execute($sql);
    }

    public function safeDown()
    {
        echo "m170416_150747_create_tbl_player_pack cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170416_150747_create_tbl_player_pack cannot be reverted.\n";

        return false;
    }
    */
}
