<?php

use app\models\Pemeriksaan;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = $pemeriksaan->tanggal;
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pasien-view">

    <h1><?= $model->nama ?></h1>

    <p class="d-none">
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

    <br>
    <h4>Pemeriksaan <?= $pemeriksaan->tanggal ?></h4>
    <?= Html::a('Update Pemeriksaan', ['pemeriksaan-update', 'pemeriksaan_id' => $pemeriksaan->id], ['class' => 'btn btn-primary mb-2']) ?>
    <?= Html::a('Hapus Pemeriksaan', ['pemeriksaan-delete', 'pemeriksaan_id' => $pemeriksaan->id], ['class' => 'btn btn-danger mb-2', 'data-method' => 'post', 'data-confirm' => 'Hapus Pemeriksaan?']) ?>
    <?php
        $searchModel  = new \app\models\PemeriksaanKriteriaSearch();
        $dataProvider = $searchModel->search(['PemeriksaanKriteriaSearch' => ['pemeriksaan_id' => $pemeriksaan->id]]);
        $dataProvider->pagination = false;
        $dataProvider->sort = false;
    ?>
    
    <?= !$pemeriksaan->pemeriksaanKriterias 
    ? '<div class="form-panel text-muted">Belum ada data.</div>' 
    : '<div class="">'.GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'kriteria_id',
                'value' => 'kriteria.nama',
            ],
            [
                'attribute' => 'subkriteria_id',
                'value' => 'subkriteria.nama',
            ],
            [
                'attribute' => 'jenis',
                'value' => 'subkriteria.kriteria.jenisText',
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'nilaiProfil',
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'nilaiTarget',
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'selisih',
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'bobot',
                'value' => 'gap.bobot',
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'keterangan',
                'value' => 'gap.keterangan',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
        ],
    ]).'</div>'; ?>

    <table class="table detail-view table-bordered">
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Total Bobot Core Factor</th>
            <td class="text-right" style="border-left:none !important; border-right:none !important"><?= $pemeriksaan->getCoreSumDetail() ?></td>
            <td class="text-right" style="border-left:none !important; border-right:none !important; width:1px !important; white-space: nowrap;">=</td>
            <td class="font-weight-bold" style="width:1px !important; white-space: nowrap; border-left:none !important;"><?= Yii::$app->formatter->asDecimal($pemeriksaan->getCoreSum(), 2) ?></td>
        </tr>
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Rata-Rata Core Factor</th>
            <td class="text-right" style="border-left:none !important; border-right:none !important"><?= $pemeriksaan->getCoreAverageDetail() ?></td>
            <td class="text-right" style="border-left:none !important; border-right:none !important; width:1px !important; white-space: nowrap;">=</td>
            <td class="font-weight-bold" style="width:1px !important; white-space: nowrap; border-left:none !important;"><?= Yii::$app->formatter->asDecimal($pemeriksaan->getCoreAverage(), 2) ?></td>
        </tr>
    </table>
    <table class="table detail-view table-bordered">
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Total Bobot Secondary Factor</th>
            <td class="text-right" style="border-left:none !important; border-right:none !important"><?= $pemeriksaan->getSecondarySumDetail() ?></td>
            <td class="text-right" style="border-left:none !important; border-right:none !important; width:1px !important; white-space: nowrap;">=</td>
            <td class="font-weight-bold" style="width:1px !important; white-space: nowrap; border-left:none !important; "><?= Yii::$app->formatter->asDecimal($pemeriksaan->getSecondarySum(), 2) ?></td>
        </tr>
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Rata-Rata Secondary Factor</th>
            <td class="text-right" style="border-left:none !important; border-right:none !important"><?= $pemeriksaan->getSecondaryAverageDetail() ?></td>
            <td class="text-right" style="border-left:none !important; border-right:none !important; width:1px !important; white-space: nowrap;">=</td>
            <td class="font-weight-bold" style="width:1px !important; white-space: nowrap; border-left:none !important; "><?= Yii::$app->formatter->asDecimal($pemeriksaan->getSecondaryAverage(), 2) ?></td>
        </tr>
    </table>
    <table class="table detail-view table-bordered">
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Hasil Akhir</th>
            <td class="text-right" style="border-left:none !important; border-right:none !important"><?= $pemeriksaan->getResultDetail() ?></td>
            <td class="text-right" style="border-left:none !important; border-right:none !important; width:1px !important; white-space: nowrap;">=</td>
            <td class="font-weight-bold" style="width:1px !important; white-space: nowrap; border-left:none !important; "><?= Yii::$app->formatter->asDecimal($pemeriksaan->getResult(), 2) ?></td>
        </tr>
        <tr>
            <th style="width:300px !important; white-space: nowrap;">Keterangan</th>
            <td class="text-right font-weight-bold" colspan="3"><?= $pemeriksaan->getResultText() ?></td>
        </tr>
    </table>
</div>
