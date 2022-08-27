<?php

use app\models\Kriteria;
use app\models\Subkriteria;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\widgets\TabularInput;

/* @var $this yii\web\View */
/* @var $model app\models\Kriteria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kriteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis')->dropDownList(Kriteria::jenisOptions(), ['prompt' => '']) ?>

    <label>Subkriteria</label>
    <div class="card grid-view tabular-input">
        <table class="table table-condensed table-hover mb-0">
            <thead>
                <tr>
                    <th>Nama Subkriteria</th>
                    <th width="150px">Nilai</th>
                    <th width="150px">Target</th>
                    <th style="width:1px; white-space:nowrap; text-align:center"><a class="btn-add btn btn-sm btn-success"><span class="fa fa-plus"></span></a></th>
                </tr>
            </thead>
            <?= TabularInput::widget([
                'id'            => 'detail-grid',
                'allModels'     => $model->subkriterias,
                'model'         => Subkriteria::className(),
                'tag'           => 'tbody',
                'form'          => $form,
                'itemOptions'   => ['tag' => 'tr'],
                'itemView'      => '_item-detail',
                'clientOptions' => [
                    'btnAddSelector' => '.btn-add',
                ]
            ]); ?>
        </table>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
