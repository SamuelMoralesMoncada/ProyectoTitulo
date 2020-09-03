<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categoria;
use app\models\Ubicacion;
use app\models\Proveedor;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */

//$this->title = $model->F_NOMBREPROD;
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
            'F_NOMBREMARCA',
            //'F_IDCAT',
            [ 
                'attribute' => 'F_IDCAT',
                'value' => function($model){
                    $marca = Categoria::findOne($model->F_IDCAT);
                    return $marca->F_NOMBRECAT;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ],  
            //'F_IDUBICA',
            [ 
                'attribute' => 'F_IDUBICA',
                'value' => function($model){
                    $marca = Ubicacion::findOne($model->F_IDUBICA);
                    return $marca->F_NOMBREUBICA;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ], 
            //'F_IDPROV',
            [ 
                'attribute' => 'F_IDPROV',
                'value' => function($model){
                    $marca = Proveedor::findOne($model->F_IDPROV);
                    return $marca->F_NOMBREPROV;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ],
            'F_NOMBREPROD',
            'F_CANTIDADPROD',
            'F_FECHAREGISTROPRO',
        ],
    ]) ?>

</div>
