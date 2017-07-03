<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use mdm\admin\components\Helper;;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page-wrapper">
    <?php
    
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'About', 'url' => ['/site/about']],
        //['label' => 'Contact', 'url' => ['/site/contact']],
        //['label' => 'Login', 'url' => ['/user/login']],
        ['label' => 'FAQ', 'items' => [
                ['label' => 'FAQ List', 'url' => ['/faq/index']],
                ['label' => 'Create FAQ', 'url' => ['/faq/create']],
        ]],
        ['label' => 'Setting', 'items' => [
            ['label' => 'Region', 'items' => [
                ['label' => 'Region List', 'url' => ['/region/index']],
                ['label' => 'Create Region', 'url' => ['/region/create']],
            ]],
            ['label' => 'Owner', 'items' => [
                ['label' => 'Owner List', 'url' => ['/owner/index']],
                ['label' => 'Create Owner', 'url' => ['/owner/create']],
            ]],
            ['label' => 'House', 'items' => [
                ['label' => 'House List', 'url' => ['/house/index']],
                ['label' => 'Create House', 'url' => ['/house/create']],
            ]],
            ['label' => 'Admin', 'url' => ['/admin/', 'type' => 'issue']],
        ]],
        [
            'label' => 'Logout',
            'url' => ['/user/security/logout'],
            'linkOptions' => ['data-method' => 'post']
        ],
    ];

    $menuItems = Helper::filter($menuItems);
    
    ?>
    <div id="page-header">
    <?php 
        
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>
    </div>
    
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
