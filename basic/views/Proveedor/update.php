<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Modificar Proveedor: ' . $model->F_NOMBREPROV;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_NOMBREPROV, 'url' => ['view', 'id' => $model->F_IDPROV]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="proveedor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
