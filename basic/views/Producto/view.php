<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Marca;
use app\models\Categoria;
use app\models\Ubicacion;
use app\models\Proveedor;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

//$this->title = $model->F_IDPROD;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->F_IDPROD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->F_IDPROD], [
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
            [ 
                'attribute' => 'F_IDMARCA',
                'value' => Marca::findOne($model->F_IDMARCA)->F_NOMBREMARCA
            ],
            [
                'attribute' => 'F_IDCAT',
                'value' => Categoria::findOne($model->F_IDCAT)->F_NOMBRECAT
            ],
            [
                'attribute' => 'F_IDUBICA',
                'value' => Ubicacion::findOne($model->F_IDUBICA)->F_NOMBREUBICA
            ],
            [
                'attribute' => 'F_IDPROV',
                'value' => Proveedor::findOne($model->F_IDPROV)->F_NOMBREPROV
            ],            
            'F_NOMBREPROD',
            'F_FECHAREGISTROPRO',
        ],
    ]) ?>

</div>
