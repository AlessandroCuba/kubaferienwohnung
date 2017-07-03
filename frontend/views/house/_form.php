<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idRegion')->textInput() ?>

    <?= $form->field($model, 'idOwner')->textInput() ?>

    <?= $form->field($model, 'houseName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'houseDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'houseAdresse')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'houseCapacity')->textInput() ?>

    <?= $form->field($model, 'houseRating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'housePriceLow')->textInput() ?>

    <?= $form->field($model, 'housePriceHigh')->textInput() ?>

    <?= $form->field($model, 'houseStatus')->textInput() ?>

    <?= $form->field($model, 'houseFlag')->textInput() ?>

    <?= $form->field($model, 'houseCreatedAt')->textInput() ?>

    <?= $form->field($model, 'houseUpdateAt')->textInput() ?>

    <?= $form->field($model, 'services')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'facilities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'houseFotos')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
