<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RoomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idroom') ?>

    <?= $form->field($model, 'houseId') ?>

    <?= $form->field($model, 'typeId') ?>

    <?= $form->field($model, 'Description') ?>

    <?= $form->field($model, 'Adult') ?>

    <?php // echo $form->field($model, 'Children') ?>

    <?php // echo $form->field($model, 'roomDimension') ?>

    <?php // echo $form->field($model, 'lowPrice') ?>

    <?php // echo $form->field($model, 'highPrice') ?>

    <?php // echo $form->field($model, 'roomStatus') ?>

    <?php // echo $form->field($model, 'roomfacilities') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
