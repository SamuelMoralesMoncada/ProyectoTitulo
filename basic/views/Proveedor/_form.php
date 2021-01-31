<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

<table>
    <tr>
        <div class="col-lg-6">

		    <?php $form = ActiveForm::begin(); ?>

		    <?= $form->field($model, 'F_NOMBREPROV')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($model, 'F_DIRECCIONPRO')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($model, 'F_ANTIGUEDADPRO')->textInput() ?>

		    <?= $form->field($model, 'F_FONOPRO')->textInput() ?>

		    <div class="form-group">
		        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		    </div>
		</div>
	</tr>
</table>

    <?php ActiveForm::end(); ?>

</div>
