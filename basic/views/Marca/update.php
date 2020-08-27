<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Marca */

$this->title = 'Actualizar marca: ' . $model->F_NOMBREMARCA;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_IDMARCA, 'url' => ['view', 'id' => $model->F_IDMARCA]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="marca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
