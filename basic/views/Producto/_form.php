<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_IDMARCA')->textInput() ?>

    <?= $form->field($model, 'F_IDCAT')->textInput() ?>

    <?= $form->field($model, 'F_IDUBICA')->textInput() ?>

    <?= $form->field($model, 'F_IDPROV')->textInput() ?>

    <?= $form->field($model, 'F_NOMBREPROD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_FECHAREGISTROPRO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
