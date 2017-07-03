<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\helpers\Html;
use yii\widgets\MaskedInput;
use kartik\widgets\FileInput;

use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Owner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">
    
    <?php
	$form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_VERTICAL,
            'options' => ['enctype' => 'multipart/form-data']
        ]);
    ?>    
    
    <div class="col-md-3 col-lg-3 " align="center">
        
        <?php
        
        if($model->ownerAvatar){
                    echo '<div><img class="img-circle" width="150" height="150" src="'.Yii::getAlias('@imgAvatarsUrl').'/'.$model->ownerAvatar.'"></div> <br>';
                    echo '<span>'.Html::a('<i class="glyphicon glyphicon-trash"></i> Borrar', ['owner/deletefoto', 'id'=> $model->id_owner], ['class'=>'btn btn-danger',  'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?')]]).'</span><p>';
        }
        
        echo $form->field($model, 'ownerAvatar')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
               'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Photo'
                ],
                ])->label(false);
        ?>        
    </div>
    <div class="col-md-9 col-lg-9"> 
       	
        <?= FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns'=>true,
            'rows'=>[[
                    'contentBefore'=>'<legend class="text-info"><small>Datos Personales</small></legend>',
                    'columns'=>6,
                    'attributes' => [       // 2 column layout
                        'ownerName' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Introduzca Nombre(s)...', 'maxlength' => 45]],
                        'ownerLastName' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Introduzca Apellidos...', 'maxlength' => 45]],
                        'ownerBirthday'=>[
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>DatePicker::classname(),
                            'options' => [
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose'=>true,
                                    'todayHighlight' => true
                                ]
                            ]
                        ],
                    ]],
                    [
                    'contentBefore'=>'<legend class="text-info"><small>Datos de Contacto</small></legend>',
                    //'autoGenerateColumns'=>false,
                    'columns' => 4,
                    'attributes' => [
                        'ownerEmail' => [
                            'type' => Form::INPUT_TEXT, 
                            'options' => [
                                'placeholder' => 'Dirección de Correo...', 
                                'columnOptions'=>['colspan'=>3]
                            ]
                        ],
                        'ownerTelef' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass'=> MaskedInput::className(),   
                            'options' =>[
                                'mask' => ['+(53) 99 999-999'],
                            ]
                        ],
                        'ownerPhone' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass'=> MaskedInput::className(),   
                            'options' =>[
                                'mask' => ['+(53) 99 999-999'],
                            ]
                        ],
                        
                    ]],
                    [
                    'attributes'=>[       // 1 column layout
                        'ownerOthers'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter notes...']],
                    ]],
                    /*[
                    'attributes' => [
                        'ownerAvatar' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => FileInput::className(),
                            'widgetoptions' =>[
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'image/*',
                                    'maxFileCount' => 1
                                ],
                            ]
                        ]
                    ]],*/
                    [
                    'attributes' =>[    
                        'actions'=>[
                                'type'=>Form::INPUT_RAW, 
                                'value'=>'<div style="text-align: right; margin-top: 20px">' . 
                                Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                                Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']) . 
                                '</div>'
                    ]]]
                    ],
                ]);
ActiveForm::end(); 
?>
</div></div>