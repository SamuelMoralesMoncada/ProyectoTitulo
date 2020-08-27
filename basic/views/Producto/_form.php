<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Marca;
use app\models\Categoria;
use app\models\Ubicacion;
use app\models\Proveedor;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">
    <table>
    <tr>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(); ?>

            <!--<?= $form->field($model, 'F_IDMARCA')->textInput() ?>-->

            <?= $form->field($model, 'F_IDMARCA')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione una marca'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                ])?>

            <!--<?= $form->field($model, 'F_IDCAT')->textInput() ?>-->

            <?= $form->field($model, 'F_IDCAT')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(categoria::find()->all(),'F_IDCAT','F_NOMBRECAT'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione una categoría'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                ])?>

            <!--<?= $form->field($model, 'F_IDUBICA')->textInput() ?>-->

            <?= $form->field($model, 'F_IDUBICA')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(ubicacion::find()->all(),'F_IDUBICA','F_NOMBREUBICA'),
                        'language' => 'es',
                        'options' => ['placeholder' => 'Seleccione una ubicación'],
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

            <?= $form->field($model, 'F_FECHAREGISTROPRO')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        
        </div>
    </tr>
</table>

    

</div>
