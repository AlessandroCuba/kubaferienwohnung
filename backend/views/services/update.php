<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Houseservices */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Services',
]) . $model->id_service;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houseservices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_houseservice, 'url' => ['view', 'id' => $model->id_service]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="houseservices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
