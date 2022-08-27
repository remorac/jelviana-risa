<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gap */

$this->title = 'Create Gap';
$this->params['breadcrumbs'][] = ['label' => 'Gaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
