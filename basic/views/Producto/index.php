<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Categoria;
use app\models\Responsable;
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
        <?= Html::a('Nuevo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'F_IDPROD',
            [ 
                'attribute' => 'F_IDCAT',
                'value' => function($model){
                    $marca = Categoria::findOne($model->F_IDCAT);
                    return $marca->F_NOMBRECAT;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ],    
            [ 
                'attribute' => 'F_IDRESP',
                'value' => function($model){
                    $marca = Responsable::findOne($model->F_IDRESP);
                    return $marca->F_NOMBRERESP;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ], 
            [ 
                'attribute' => 'F_IDPROV',
                'value' => function($model){
                    $marca = Proveedor::findOne($model->F_IDPROV);
                    return $marca->F_NOMBREPROV;
                },
                //'filter' => ArrayHelper::map(Marca::find()->all(),'F_IDMARCA','F_NOMBREMARCA'),
            ], 
            'F_NOMBREPROD',
            'F_FECHAREGISTROPRO',
            //'F_NOMBREMARCA',
            'F_ESTADO',
            //'F_DESCRIPRO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
