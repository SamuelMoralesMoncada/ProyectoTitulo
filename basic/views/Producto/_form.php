<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Categoria;
use app\models\Ubicacion;
use app\models\Proveedor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">
    <table>
    <tr>
        <div class="col-lg-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'F_NOMBREMARCA')->textInput(['style'=>'width:100%'],['maxlength' => true]) ?> 

    <?= $form->field($model, 'F_IDCAT')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(categoria::find()->all(),'F_IDCAT','F_NOMBRECAT'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione un producto'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
    ])?>

    <?= $form->field($model, 'F_IDUBICA')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(ubicacion::find()->all(),'F_IDUBICA','F_NOMBREUBICA'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione un producto'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
    ])?>

    <?= $form->field($model, 'F_IDPROV')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(proveedor::find()->all(),'F_IDPROV','F_NOMBREPROV'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione un producto'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
    ])?>

    <?= $form->field($model, 'F_NOMBREPROD')->textInput(['style'=>'width:100%'],['maxlength' => true]) ?>

    <?= $form->field($model, 'F_CANTIDADPROD')->textInput(['type' => 'number'],['style'=>'width:100%'],['maxlength' => true]) ?>


    <?= $form->field($model, 'F_FECHAREGISTROPRO')->widget(DatePicker::classname(), [
                'language' => 'ES',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?> 

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</tr>
</table>

</div>
