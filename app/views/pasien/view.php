<?php

use app\models\Pemeriksaan;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pasien-view">

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
        'options' => ['class' => 'table table-bordered detail-view'],
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'umur',
            'alamat',
        ],
    ]) ?>

    <h4>Pemeriksaan</h4>
    <?= Html::a('Pemeriksaan Baru', ['pemeriksaan-create', 'id' => $model->id], ['class' => 'btn btn-success mb-2']) ?>
    <?php
        $searchModel  = new \app\models\PemeriksaanSearch();
        $dataProvider = $searchModel->search(['PemeriksaanSearch' => ['kriteria_id' => $model->id]]);
        $dataProvider->pagination = false;
    ?>
    
    <?= !$model->pemeriksaans 
    ? '<div class="form-panel text-muted">Belum ada data.</div>' 
    : '<div class="">'.GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'tanggal',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'hasil',
                'value' => 'result',
                'format' => ['decimal', 2],
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'keterangan',
                'value' => 'resultText',
                'format' => 'html',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pemeriksaan $model, $key, $index, $column) {
                    return Url::toRoute(['pemeriksaan-'.$action, 'pemeriksaan_id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
        ],
    ]).'</div>'; ?>
</div>
