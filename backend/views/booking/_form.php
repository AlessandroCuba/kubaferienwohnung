<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use common\models\House;
use common\models\BoockStatus;

/* @var $this yii\web\View */
/* @var $model common\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'idHouse')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(House::find()->asArray()->all(), 'id_house', 'houseName'),
            'options' => ['placeholder' => 'Select a House ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?php echo '<label class="control-label">Select date range</label>'; ?>
    <?= DatePicker::widget([
            'model' => $model,
            'form' => $form,
            'attribute' => 'CheckInDate',
            'attribute2' => 'CheckOutDate',
            'options' => ['placeholder' => 'Start date'],
            'options2' => ['placeholder' => 'End date'],
            'type' => DatePicker::TYPE_RANGE,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);
    ?>

    

    <?= $form->field($model, 'PersonenNo')->textInput() ?>
    
    <?= $form->field($model, 'idstatus')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(BoockStatus::find()->asArray()->all(), 'id_boockStatus', 'statusDescription'),
            'options' => ['placeholder' => 'Select a Status ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
