<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Houseservices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="houseservices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_service')->textInput() ?>

    <?= $form->field($model, 'Denominations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
