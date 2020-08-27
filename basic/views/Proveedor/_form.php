<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_NOMBREPROV')->textInput(['style'=>'width:50%'],['maxlength' => true]) ?>

    <?= $form->field($model, 'F_DIRECCIONPRO')->textInput(['style'=>'width:50%'],['maxlength' => true]) ?>

    <?= $form->field($model, 'F_ANTIGUEDADPRO')->textInput(['style'=>'width:50%']) ?>

    <?= $form->field($model, 'F_FONOPRO')->textInput(['style'=>'width:50%']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
