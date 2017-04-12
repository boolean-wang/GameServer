<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Player;

/**
 * PlayerSearch represents the model behind the search form of `common\models\Player`.
 */
class PlayerSearch extends Player
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'u_id', 'sex', 'school', 'role', 'level', 'current_experience', 'upgrade_experience', 'shang_hai', 'ming_zhong', 'ling_li', 'fang_yu', 'hp', 'mp', 'sp', 'speed', 'fa_shang', 'fa_fang', 'attack_point', 'defence_point', 'physical_point', 'magic_point', 'speed_point', 'potential'], 'integer'],
            [['logout_time', 'nickname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Player::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'u_id' => $this->u_id,
            'sex' => $this->sex,
            'school' => $this->school,
            'role' => $this->role,
            'level' => $this->level,
            'current_experience' => $this->current_experience,
            'upgrade_experience' => $this->upgrade_experience,
            'shang_hai' => $this->shang_hai,
            'ming_zhong' => $this->ming_zhong,
            'ling_li' => $this->ling_li,
            'fang_yu' => $this->fang_yu,
            'hp' => $this->hp,
            'mp' => $this->mp,
            'sp' => $this->sp,
            'speed' => $this->speed,
            'fa_shang' => $this->fa_shang,
            'fa_fang' => $this->fa_fang,
            'attack_point' => $this->attack_point,
            'defence_point' => $this->defence_point,
            'physical_point' => $this->physical_point,
            'magic_point' => $this->magic_point,
            'speed_point' => $this->speed_point,
            'potential' => $this->potential,
        ]);

        $query->andFilterWhere(['like', 'logout_time', $this->logout_time])
            ->andFilterWhere(['like', 'nickname', $this->nickname]);

        return $dataProvider;
    }
}
