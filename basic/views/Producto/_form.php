<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\models\Categoria;
use app\models\Responsable;
use app\models\Proveedor;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">


<table>
    <tr>
        <div class="col-lg-6">

            <?php $form = ActiveForm::begin(); ?>

            <!--<?= $form->field($model, 'F_IDCAT')->textInput() ?>-->

            <?= $form->field($model, 'F_IDCAT')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(categoria::find()->all(),'F_IDCAT','F_NOMBRECAT'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione una categoría'],
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

            <!--<?= $form->field($model, 'F_IDPROV')->textInput() ?>-->

            <?= $form->field($model, 'F_IDPROV')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(proveedor::find()->all(),'F_IDPROV','F_NOMBREPROV'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione un proveedor'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                ])?>

            <?= $form->field($model, 'F_NOMBREPROD')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'F_NOMBREMARCA')->textInput(['maxlength' => true]) ?>

            <!--<?= $form->field($model, 'F_ESTADO')->textInput(['maxlength' => true]) ?>-->


            <?= $form->field($model, 'F_ESTADO')->dropDownList(
            ['Asignado' => 'Asignado', 'De baja' => 'De baja']
            ); ?>

            <?= $form->field($model, 'F_DESCRIPRO')->textarea(array('rows'=>5,'cols'=>5)); ?>

            <!--<?= $form->field($model, 'F_FECHAREGISTROPRO')->textInput() ?>-->

            <?= $form->field($model, 'F_FECHAREGISTROPRO')->widget(DatePicker::classname(), [
                'language' => 'ES',
                'dateFormat' => 'dd-MM-yyyy',
            ]) ?> 

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </tr>
</table>

    <?php ActiveForm::end(); ?>

</div>
