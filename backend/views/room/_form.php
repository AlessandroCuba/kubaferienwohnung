<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'houseId')->textInput() ?>

    <?= $form->field($model, 'typeId')->textInput() ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Adult')->textInput() ?>

    <?= $form->field($model, 'Children')->textInput() ?>

    <?= $form->field($model, 'roomDimension')->textInput() ?>

    <?= $form->field($model, 'lowPrice')->textInput() ?>

    <?= $form->field($model, 'highPrice')->textInput() ?>

    <?= $form->field($model, 'roomStatus')->textInput() ?>

    <?= $form->field($model, 'roomfacilities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
