<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_booking') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'idHouse') ?>

    <?= $form->field($model, 'bookingDate') ?>

    <?= $form->field($model, 'CheckInDate') ?>

    <?php // echo $form->field($model, 'CheckOutDate') ?>

    <?php // echo $form->field($model, 'PersonenNo') ?>

    <?php // echo $form->field($model, 'idstatus') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
