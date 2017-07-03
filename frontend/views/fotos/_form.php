<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fotos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fotos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'houseid')->textInput() ?>

    <?= $form->field($model, 'fotoName')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
