<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categoria;
use app\models\Responsable;
use app\models\Proveedor;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Producto: '.$model->F_NOMBREPROD;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->F_IDPROD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->F_IDPROD], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'F_IDPROD',
            [
                'attribute' => 'F_IDCAT',
                'value' => Categoria::findOne($model->F_IDCAT)->F_NOMBRECAT
            ],
            [
                'attribute' => 'F_IDRESP',
                'value' => Responsable::findOne($model->F_IDRESP)->F_NOMBRERESP
            ],
            [
                'attribute' => 'F_IDPROV',
                'value' => Proveedor::findOne($model->F_IDPROV)->F_NOMBREPROV
            ],
            'F_NOMBREPROD',
            'F_FECHAREGISTROPRO',
            'F_NOMBREMARCA',
            'F_ESTADO',
            'F_DESCRIPRO',
        ],
    ]) ?>

</div>
