<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ubicacion */

$this->title = 'Actualizar ubicación: ' . $model->F_NOMBREUBICA;
$this->params['breadcrumbs'][] = ['label' => 'Ubicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_IDUBICA, 'url' => ['view', 'id' => $model->F_IDUBICA]];
$this->params['breadcrumbs'][] = 'Guardar';
?>
<div class="ubicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
