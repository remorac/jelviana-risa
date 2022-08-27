<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selisih')->textInput() ?>

    <?= $form->field($model, 'bobot')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
