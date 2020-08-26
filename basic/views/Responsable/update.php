<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Responsable */

//$this->title = 'Actualizar responsable: ' . $model->F_NOMBRERESP;
$this->params['breadcrumbs'][] = ['label' => 'Responsables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_IDRESP, 'url' => ['view', 'id' => $model->F_IDRESP]];
$this->params['breadcrumbs'][] = 'Guardar';
?>
<div class="responsable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
