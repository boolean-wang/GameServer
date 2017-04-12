<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'u_id')->textInput() ?>

    <?= $form->field($model, 'logout_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'school')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'current_experience')->textInput() ?>

    <?= $form->field($model, 'upgrade_experience')->textInput() ?>

    <?= $form->field($model, 'shang_hai')->textInput() ?>

    <?= $form->field($model, 'ming_zhong')->textInput() ?>

    <?= $form->field($model, 'ling_li')->textInput() ?>

    <?= $form->field($model, 'fang_yu')->textInput() ?>

    <?= $form->field($model, 'hp')->textInput() ?>

    <?= $form->field($model, 'mp')->textInput() ?>

    <?= $form->field($model, 'sp')->textInput() ?>

    <?= $form->field($model, 'speed')->textInput() ?>

    <?= $form->field($model, 'fa_shang')->textInput() ?>

    <?= $form->field($model, 'fa_fang')->textInput() ?>

    <?= $form->field($model, 'attack_point')->textInput() ?>

    <?= $form->field($model, 'defence_point')->textInput() ?>

    <?= $form->field($model, 'physical_point')->textInput() ?>

    <?= $form->field($model, 'magic_point')->textInput() ?>

    <?= $form->field($model, 'speed_point')->textInput() ?>

    <?= $form->field($model, 'potential')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
