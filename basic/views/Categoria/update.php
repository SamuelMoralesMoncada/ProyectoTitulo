<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Modificar Categoría: ' . $model->F_NOMBRECAT; 
$this->params['breadcrumbs'][] = ['label' => 'Categorías', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_NOMBRECAT, 'url' => ['view', 'id' => $model->F_IDCAT]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
