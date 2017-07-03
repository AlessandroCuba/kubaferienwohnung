<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roomtype */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Roomtype',
]) . $model->idroom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roomtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idroom, 'url' => ['view', 'id' => $model->idroom]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="roomtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
