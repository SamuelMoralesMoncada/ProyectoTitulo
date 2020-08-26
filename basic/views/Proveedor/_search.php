<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'F_IDPROV') ?>

    <?= $form->field($model, 'F_NOMBREPROV') ?>

    <?= $form->field($model, 'F_DIRECCIONPRO') ?>

    <?= $form->field($model, 'F_ANTIGUEDADPRO') ?>

    <?= $form->field($model, 'F_FONOPRO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
