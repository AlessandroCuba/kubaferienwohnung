<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Booking */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Booking',
]) . $model->id_booking;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_booking, 'url' => ['view', 'id' => $model->id_booking]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="booking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
