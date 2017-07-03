<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Room',
]) . $model->idroom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idroom, 'url' => ['view', 'id' => $model->idroom]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
