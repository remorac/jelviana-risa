<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = 'Update Pemeriksaan';
$this->params['breadcrumbs'][] = ['label' => 'Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $pemeriksaan->tanggal, 'url' => ['pemeriksaan-view', 'pemeriksaan_id' => $pemeriksaan->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-pemeriksaan', [
        'model' => $model,
        'pemeriksaan' => $pemeriksaan,
    ]) ?>

</div>
