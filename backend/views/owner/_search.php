<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OwnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_owner') ?>

    <?= $form->field($model, 'ownerName') ?>

    <?= $form->field($model, 'ownerLastName') ?>

    <?= $form->field($model, 'ownerTelef') ?>

    <?= $form->field($model, 'ownerPhone') ?>

    <?php // echo $form->field($model, 'ownerEmail') ?>

    <?php // echo $form->field($model, 'ownerPassword') ?>

    <?php // echo $form->field($model, 'ownerAvatar') ?>

    <?php // echo $form->field($model, 'ownerCreatedAt') ?>

    <?php // echo $form->field($model, 'ownerUpdateAt') ?>

    <?php // echo $form->field($model, 'idLanguage') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
