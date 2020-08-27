<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */

$this->title = $model->F_IDPROD;
$this->params['breadcrumbs'][] = ['label' => 'Asignaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asigna-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este dato?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'F_IDPROD',
            'F_IDRESP',
            'F_FECHAASIGNA',
        ],
    ]) ?>

</div>
