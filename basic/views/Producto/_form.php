<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_IDMARCA')->textInput(['style'=>'width:50%']) ?>

    <?= $form->field($model, 'F_IDCAT')->textInput(['style'=>'width:50%']) ?>

    <?= $form->field($model, 'F_IDUBICA')->textInput(['style'=>'width:50%']) ?>

    <?= $form->field($model, 'F_IDPROV')->textInput(['style'=>'width:50%']) ?>

    <?= $form->field($model, 'F_NOMBREPROD')->textInput(['style'=>'width:50%'],['maxlength' => true]) ?>

    <?= $form->field($model, 'F_FECHAREGISTROPRO')->textInput(['style'=>'width:50%']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
