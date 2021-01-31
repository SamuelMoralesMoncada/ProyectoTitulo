<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'F_IDPROD') ?>

    <?= $form->field($model, 'F_IDCAT') ?>

    <?= $form->field($model, 'F_IDRESP') ?>

    <?= $form->field($model, 'F_IDPROV') ?>

    <?= $form->field($model, 'F_NOMBREPROD') ?>

    <?php // echo $form->field($model, 'F_FECHAREGISTROPRO') ?>

    <?php // echo $form->field($model, 'F_NOMBREMARCA') ?>

    <?php // echo $form->field($model, 'F_ESTADO') ?>

    <?php // echo $form->field($model, 'F_DESCRIPRO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
