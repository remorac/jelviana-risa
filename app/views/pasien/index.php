<?php

use app\models\Pasien;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Pasien', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /* [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ], */
            'nama',
            [
                'attribute' => 'umur',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            'alamat',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pasien $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                 'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
        ],
    ]); ?>


</div>
