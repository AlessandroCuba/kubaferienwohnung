<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = Yii::t('app', 'Create House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-9">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsRooms' => $modelsRooms,
    ]) ?>