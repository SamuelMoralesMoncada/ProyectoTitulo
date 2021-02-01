<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Categoria;
use app\models\Responsable;
use yii\helpers\ArrayHelper;
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
                'filter' => ArrayHelper::map(Categoria::find()->all(),'F_IDCAT','F_NOMBRECAT'),
            ],    
            [ 
                'attribute' => 'F_IDRESP',
                'value' => function($model){
                    $marca = Responsable::findOne($model->F_IDRESP);
                    return $marca->F_NOMBRERESP;
                },
                'filter' => ArrayHelper::map(Responsable::find()->all(),'F_IDRESP','F_NOMBRERESP'),
            ], 
            [ 
                'attribute' => 'F_IDPROV',
                'value' => function($model){
                    $marca = Proveedor::findOne($model->F_IDPROV);
                    return $marca->F_NOMBREPROV;
                },
                'filter' => ArrayHelper::map(Proveedor::find()->all(),'F_IDPROV','F_NOMBREPROV'),
            ], 
            'F_NOMBREPROD',
            'F_FECHAREGISTROPRO',
            //'F_NOMBREMARCA',
            [
                'attribute' => 'F_ESTADO',
                'filter'=> array('Asignado' => 'Asignado', 'De baja' => 'De baja'),
            ],
            //'F_ESTADO',
            //'F_DESCRIPRO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
