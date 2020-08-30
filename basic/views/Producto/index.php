<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Marca;
use app\models\Categoria;
use app\models\Ubicacion;
use app\models\Proveedor;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo registro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'F_IDPROD',
            [ 
                'attribute' => 'F_IDMARCA',
                'value' => function($model){
                    $marca = Marca::findOne($model->F_IDMARCA);
                    return $marca->F_NOMBREMARCA;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ],    
            //'F_IDCAT',
            [
                'attribute' => 'F_IDCAT',
                'value' => function($model){
                    $marca = Categoria::findOne($model->F_IDCAT);
                    return $marca->F_NOMBRECAT;
                },
                //'filter' => ArrayHelper::map(Categoria::find()->all(),'F_IDCAT','F_NOMBRECAT'),
            ],
            //'F_IDUBICA',
            [
                'attribute' => 'F_IDUBICA',
                'value' => function($model){
                    $marca = Ubicacion::findOne($model->F_IDUBICA);
                    return $marca->F_NOMBREUBICA;
                },
                //'filter' => ArrayHelper::map(Ubicacion::find()->all(),'F_IDUBICA','F_NOMBREUBICA'),
            ],

            //'F_IDPROV',
            [
                'attribute' => 'F_IDPROV',
                'value' => function($model){
                    $marca = Proveedor::findOne($model->F_IDPROV);
                    return $marca->F_NOMBREPROV;
                },
                //'filter' => ArrayHelper::map(Proveedor::find()->all(),'F_IDPROV','F_NOMBREPROV'),
            ],

            'F_NOMBREPROD',
            'F_FECHAREGISTROPRO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
