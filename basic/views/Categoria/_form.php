<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

<table>
    <tr>
        <div class="col-lg-6">

		    <?php $form = ActiveForm::begin(); ?>

		    <?= $form->field($model, 'F_NOMBRECAT')->textInput(['maxlength' => true]) ?>

		    <div class="form-group">
		        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		    </div>

		</div>
	</tr>
</table>

    <?php ActiveForm::end(); ?>

</div>
