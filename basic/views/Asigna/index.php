<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsignaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asigna-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar nuevo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'F_IDPROD',
            'F_IDRESP',
            'F_FECHAASIGNA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
