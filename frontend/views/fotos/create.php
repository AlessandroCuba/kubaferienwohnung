<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Fotos */

$this->title = Yii::t('app', 'Create Fotos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fotos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
