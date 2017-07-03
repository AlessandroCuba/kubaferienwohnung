<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idRegion') ?>

    <?= $form->field($model, 'idOwner') ?>

    <?= $form->field($model, 'houseName') ?>

    <?= $form->field($model, 'houseDescription') ?>

    <?php // echo $form->field($model, 'houseAdresse') ?>

    <?php // echo $form->field($model, 'houseCapacity') ?>

    <?php // echo $form->field($model, 'houseRating') ?>

    <?php // echo $form->field($model, 'housePriceLow') ?>

    <?php // echo $form->field($model, 'housePriceHigh') ?>

    <?php // echo $form->field($model, 'houseStatus') ?>

    <?php // echo $form->field($model, 'houseFlag') ?>

    <?php // echo $form->field($model, 'houseCreatedAt') ?>

    <?php // echo $form->field($model, 'houseUpdateAt') ?>

    <?php // echo $form->field($model, 'services') ?>

    <?php // echo $form->field($model, 'facilities') ?>

    <?php // echo $form->field($model, 'houseFotos') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
