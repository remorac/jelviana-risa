<?php

use app\models\Pasien;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;

$years = [];
for ($i = date('Y'); $i >= 2018 ; $i--) { 
    $years[$i] = $i;
}
$months = [];
for ($i = 1; $i <= 12 ; $i++) { 
    $months[$i] = date('F', mktime(0, 0, 0, $i, 10));
}

?>
<div class="pasien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['action' => ['/laporan'], 'method' => 'get']); ?>
    <table>
        <tr>
            <td width="200px;" style="padding-right:10px"><?= Html::dropDownList('month', $month, $months, ['class' => 'form-control']) ?></td>
            <td width="100px;" style="padding-right:10px"><?= Html::dropDownList('year', $year, $years, ['class' => 'form-control']) ?></td>
            <td width="100px;" style="padding-right:10px"><?= Html::submitButton('Refresh', ['class' => 'btn btn-info']) ?></td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

    <p></p>
    <div class="printable" style="border:2px solid #ddd; border-radius:8px; box-shadow: inset 0 0 0px rgba(0,0,0,0.05)">
        <table class="table" style="margin-bottom: 0;">
            <tr>
                <th style="border-top: none;">No.</th>
                <th style="border-top: none;">Tanggal</th>
                <th style="border-top: none;">Nama</th>
                <th style="border-top: none;">Hasil</th>
                <th style="border-top: none;">Keterangan</th>
            </tr>
        <?php $i = 0; ?>
        <?php foreach ($pemeriksaans as $pemeriksaan) { ?>
            <tr>
                <td class="text-center" style="width:1px; white-space:nowrap"><?= ++$i ?></td>
                <td style="width:1px; white-space:nowrap"><?= $pemeriksaan->tanggal; ?></td>
                <td><?= $pemeriksaan->pasien->nama; ?></td>
                <td style="width:1px; white-space:nowrap"><?= Yii::$app->formatter->asDecimal($pemeriksaan->result, 2); ?></td>
                <td style="width:1px; white-space:nowrap"><?= $pemeriksaan->resultText; ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>

</div>
