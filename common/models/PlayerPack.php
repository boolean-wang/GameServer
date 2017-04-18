<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "player_pack".
 *
 * @property int $id
 * @property int $u_id
 * @property string $name 物品名称
 * @property int $num 数量
 * @property string $attr 物品属性 json
 */
class PlayerPack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player_pack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'u_id', 'name'], 'required'],
            [['id', 'u_id', 'num'], 'integer'],
            [['name', 'attr'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'num' => 'Num',
            'attr' => 'Attr',
        ];
    }
}
