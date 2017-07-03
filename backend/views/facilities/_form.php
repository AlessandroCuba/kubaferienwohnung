<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Roomfacility */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roomfacility-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Denominations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->dropDownList(['1' => 'En la casa', '2' => 'En la Habitacion', '3' => 'Casa o Habitacion'],['prompt'=>'Select Option']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
