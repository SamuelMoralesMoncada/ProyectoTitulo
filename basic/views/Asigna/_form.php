<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asigna-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_IDPROD')->textInput() ?>

    <?= $form->field($model, 'F_IDRESP')->textInput() ?>

    <?= $form->field($model, 'F_FECHAASIGNA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
