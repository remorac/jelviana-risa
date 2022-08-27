<?php

use app\models\Gap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gap';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gap-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="d-none">
        <?= Html::a('Create Gap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover table-bordered grid-view'],
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'selisih',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            [
                'attribute' => 'bobot',
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ],
            'keterangan',
            /* [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gap $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width:1px; white-space:nowrap;'],
                'contentOptions' => ['style' => 'width:1px; white-space:nowrap;'],
            ], */
        ],
    ]); ?>


</div>
