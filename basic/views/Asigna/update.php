<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */

$this->title = 'Update Asigna: ' . $model->F_IDPROD;
$this->params['breadcrumbs'][] = ['label' => 'Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->F_IDPROD, 'url' => ['view', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asigna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
