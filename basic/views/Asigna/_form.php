<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Producto;
use app\models\Responsable;
use kartik\select2\Select2;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asigna-form">
	<table>
	<tr>
    	<div class="col-lg-6">
    		<?php $form = ActiveForm::begin(); ?>
			   	<!--<?= $form->field($model, 'F_IDPROD')->textInput() ?> -->

			    <?= $form->field($model, 'F_IDPROD')->widget(Select2::classname(), [
			        'data' => ArrayHelper::map(producto::find()->all(),'F_IDPROD','F_NOMBREPROD'),
				        'language' => 'es',
				        'options' => ['placeholder' => 'Seleccione un producto'],
				        'pluginOptions' => [
				            'allowClear' => true
				        ],
			    ])?>

			    <!--<?= $form->field($model, 'F_IDRESP')->textInput() ?>-->

			    <?= $form->field($model, 'F_IDRESP')->widget(Select2::classname(), [
				        'data' => ArrayHelper::map(responsable::find()->all(),'F_IDRESP','F_NOMBRERESP'),
				        'language' => 'es',
				        'options' => ['placeholder' => 'Seleccione un responsable'],
				        'pluginOptions' => [
				            'allowClear' => true
				        ],
			    ])?>			

			    <?= $form->field($model, 'F_FECHAASIGNA')->widget(DatePicker::classname(), [
                'language' => 'ES',
                'dateFormat' => 'dd-MM-yyyy',
            ]) ?>

			    <div class="form-group">
			        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>

	    	</div>
	    </tr>
	</table>

</div>
