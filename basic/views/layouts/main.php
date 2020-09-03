<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Existencias M&I',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            //['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Nuevo',
                    'url' => ['#'],
                    'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                    'items' => [
                            ['label' => 'Proveedor', 'url' => ['/proveedor/create']],
                            ['label' => 'Ubicación', 'url' => ['/ubicacion/create']],
                            ['label' => 'Responsable', 'url' => ['/responsable/create']],
                            ['label' => 'Producto', 'url' => ['/producto/create']],
                            //['label' => 'Producto', 'url' => ['/marca/create']],
                    ]
            ],
            //['label' => 'Proveedor', 'url' => ['/proveedor']],
            //['label' => 'Marca', 'url' => ['/marca']],
            //['label' => 'Ubicación', 'url' => ['/ubicacion']],
            //['label' => 'Responsable', 'url' => ['/responsable']],
            ['label' => 'Asignación', 'url' => ['/asigna']],
            //['label' => 'Categoría', 'url' => ['/categoria']],
            //['label' => 'Producto', 'url' => ['/producto']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Colegio Andrés Bello <?= date('Y') ?></p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
