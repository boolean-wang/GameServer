<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Player */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'u_id',
            'logout_time',
            'nickname',
            'sex',
            'school',
            'role',
            'level',
            'current_experience',
            'upgrade_experience',
            'shang_hai',
            'ming_zhong',
            'ling_li',
            'fang_yu',
            'hp',
            'mp',
            'sp',
            'speed',
            'fa_shang',
            'fa_fang',
            'attack_point',
            'defence_point',
            'physical_point',
            'magic_point',
            'speed_point',
            'potential',
        ],
    ]) ?>

</div>
