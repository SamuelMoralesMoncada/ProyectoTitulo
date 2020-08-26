<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Asigna */

$this->title = 'Create Asigna';
$this->params['breadcrumbs'][] = ['label' => 'Asignas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asigna-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
