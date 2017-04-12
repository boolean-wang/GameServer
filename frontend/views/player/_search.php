<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'u_id') ?>

    <?= $form->field($model, 'logout_time') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'school') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'current_experience') ?>

    <?php // echo $form->field($model, 'upgrade_experience') ?>

    <?php // echo $form->field($model, 'shang_hai') ?>

    <?php // echo $form->field($model, 'ming_zhong') ?>

    <?php // echo $form->field($model, 'ling_li') ?>

    <?php // echo $form->field($model, 'fang_yu') ?>

    <?php // echo $form->field($model, 'hp') ?>

    <?php // echo $form->field($model, 'mp') ?>

    <?php // echo $form->field($model, 'sp') ?>

    <?php // echo $form->field($model, 'speed') ?>

    <?php // echo $form->field($model, 'fa_shang') ?>

    <?php // echo $form->field($model, 'fa_fang') ?>

    <?php // echo $form->field($model, 'attack_point') ?>

    <?php // echo $form->field($model, 'defence_point') ?>

    <?php // echo $form->field($model, 'physical_point') ?>

    <?php // echo $form->field($model, 'magic_point') ?>

    <?php // echo $form->field($model, 'speed_point') ?>

    <?php // echo $form->field($model, 'potential') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
