<?php

use app\models\PemeriksaanKriteria;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use mdm\widgets\TabularInput;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-form">
    <?= DetailView::widget([
        'options' => ['class' => 'table table-bordered detail-view'],
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'umur',
            'alamat',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <div style="width:200px">
    <?= $form->field($pemeriksaan, 'tanggal')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Pilih tanggal'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>
    </div>

    <!-- <label>Kriteria</label> -->
    <div class="card grid-view tabular-input">
        <table class="table table-condensed table-hover mb-0">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th width="35%">Subkriteria</th>
                    <th style="width:1px; white-space:nowrap; text-align:center"><a class="btn-add btn btn-sm btn-success"><span class="fa fa-plus"></span></a></th>
                </tr>
            </thead>
            <?= TabularInput::widget([
                'id'            => 'detail-grid',
                'allModels'     => $pemeriksaan->pemeriksaanKriterias,
                'model'         => PemeriksaanKriteria::className(),
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
