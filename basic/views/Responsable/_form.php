<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Responsable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_NOMBRERESP')->textInput(['style'=>'width:50%'],['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
