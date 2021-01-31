<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            ['class' => 'yii\grid\SerialColumn'],

            'F_IDPROD',
            'F_IDCAT',
            'F_IDRESP',
            'F_IDPROV',
            'F_NOMBREPROD',
            //'F_FECHAREGISTROPRO',
            //'F_NOMBREMARCA',
            //'F_ESTADO',
            //'F_DESCRIPRO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
