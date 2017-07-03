<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Province;

use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'regionName')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'idProvince')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Province::find()->orderBy('id_province')->asArray()->all(), 'id_province', 'provinceName'),
            'options' => ['placeholder' => 'Select Province ...'],
            'theme' => 'bootstrap',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
