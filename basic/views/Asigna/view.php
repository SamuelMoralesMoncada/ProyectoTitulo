<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */

$this->title = $model->F_IDPROD;
$this->params['breadcrumbs'][] = ['label' => 'Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asigna-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
