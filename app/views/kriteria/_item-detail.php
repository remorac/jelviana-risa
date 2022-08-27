<?php

use app\models\Kriteria;
use app\models\Subkriteria;
use common\models\entity\Cash;
use common\models\entity\Item;
use common\models\entity\Payment;
use kartik\checkbox\CheckboxX;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;

?>

<td>
    <?= Html::activeHiddenInput($model, "[$key]id") ?>
    <?= Html::activeTextInput($model, "[$key]nama",   ['class' => 'form-control']) ?>
</td>
<td><?= Html::activeTextInput($model, "[$key]nilai",   ['class' => 'form-control', 'type' => 'number']) ?></td>
<td><?= Html::activeDropDownList($model, "[$key]target", Subkriteria::targetOptions(),  ['class' => 'form-control']) ?></td>

<td style="width:1px; white-space:nowrap; text-align:right; vertical-align:middle">
    <a data-action="delete" title="Delete" href="#" class="btn btn-sm btn-outline-danger"><span class="fa fa-times"></span></a>
</td>
