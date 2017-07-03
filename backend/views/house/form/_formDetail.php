<?php
use common\models\Province;
use common\models\Region;
use common\models\Owner;
use common\models\ReservaType;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\SwitchInput;
use kartik\builder\FormGrid;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

    $rows = [[
            'contentBefore'=>'<legend class="text-info"><small>Location</small></legend>',
            'attributes'=>[
                'columns'=>6,
                'provincia'=> [
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => Select2::classname(),
                    'options' => [
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => false,
                        'options' => ['placeholder' => '-- Province --',  'columnOptions'=>['colspan'=>3]],
                        'data'=>ArrayHelper::map(Province::find()->orderBy('id_province')->asArray()->all(), 'id_province', 'provinceName'),
                        
                    ]
                ],
                'idRegion'=> [
                    'label' => 'Region ('.Html::a('new Region', ['#']).')',
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => DepDrop::classname(),
                    'options' => [
                        'type' => DepDrop::TYPE_SELECT2,
                        //'hideSearch' => false,
                        'pluginOptions' => [
                            'url' => Url::to(['/house/region']),
                            'depends' => ['house-provincia'],
                            'id'=>'house-idregion',
                        ],
                        'options' => [
                                'placeholder' => '-- Seleccione la Region --',
                                'columnOptions'=>['colspan'=>3]
                        ],
                        'data'=>ArrayHelper::map(Region::find()->orderBy('id_region')->asArray()->all(), 'id_region', 'regionName'),
                    ]
                ],
            ]],
            [
            'attributes' => [
                'typeReserveId'=> [
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => Select2::classname(),
                    'options' => [
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => false,
                        'options' => ['placeholder' => '-- Seleccione --',  'columnOptions'=>['colspan'=>3]],
                        'data'=>ArrayHelper::map(ReservaType::find()->orderBy('id')->asArray()->all(), 'id', 'bookingType'),
                        
                    ]
                ],
                'houseStatus'=>[
                    'type' => Form::INPUT_WIDGET, 
                    'widgetClass'=> Select2::className(),
                    'options' => [
                        'theme'=>Select2::THEME_BOOTSTRAP,
                        'data'=>[0=>'Libre', 1=>'Ocupada', 2=>'Fuera de Servicio'],
                        'hideSearch'=>true,
                        'options'=>['columnOptions'=>['colspan'=>3]],
                    ]
                ],
                'houseFlag'=>[
                    'type' => Form::INPUT_WIDGET, 
                    'widgetClass'=> SwitchInput::className(),
                    'options' => [
                        'pluginOptions'=>[
                            //'handleWidth'=>60,
                            'onText'=>'Active',
                            'offText'=>'Inactive'
                        ]
                    ]
                ], 
            ]],
            [
            'contentBefore'=>'<legend class="text-info"><small>Datos de la Casa</small></legend>',
            'attributes'=>[
                'houseName'=>[
                    'type' => Form::INPUT_TEXT, 
                    'options' => ['placeholder' => 'Introduzca Nombre(s)...', 'maxlength' => 45]
                ],
                'idOwner'=> [
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => Select2::classname(),
                    'options' => [
                        'theme' => Select2::THEME_KRAJEE,
                        'hideSearch' => false,
                        'options' => ['placeholder' => '-- Seleccione el Propietario --'],
                        'data'=>ArrayHelper::map(Owner::find()->orderBy('id_owner')->all(), 'id_owner', 'ownerNameFull'),
                    ]
                ],
                'actions'=>[    // embed raw HTML content
                    'type'=>Form::INPUT_RAW, 
                    'value'=>   '<div style="text-align: left; margin-top: 24px">'
                                .Html::button('<i class="glyphicon glyphicon-plus"></i> New Owner', ['value' => Html::a('owner/create'), 'class' => 'btn btn-success'])
                                .'</div>'
                ],
            ]],
            [
            'attributes'=>[
                'houseAdresse'=>[
                    'type'=>Form::INPUT_TEXTAREA, 
                    'options'=>['placeholder'=>'Entre la dirección de la casa...']
                ],
            ]],
            [
            'attributes'=>[
                'houseDescription'=>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> TinyMce::className(),
                    'options'=>[
                        'options' => ['rows' => 10],
                        'language' => 'es',
                        'clientOptions' => [
                            'plugins' => [
                                "autolink lists link charmap preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ]
                ],
            ]],
            [
            'contentBefore'=>'<legend class="text-info"><small>Servicios y Facilidades en la Casa</small></legend>',
            'attributes'=>[
                'editableFacilitie'=>[ 
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => Select2::classname(),
                    'options' => [
                        'data' => $model->facilitiesArray,
                        'theme' => Select2::THEME_KRAJEE,
                        'hideSearch' => false,
                        'options' => ['placeholder' => '-- Seleccion las Facilidades --', 'multiple' => true,],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [',', ' '],
                        ],
                    ],
                ],
                'aeropuertoId'=> [
                    'label' => 'Airport ('.Html::a('new Airport', ['#']).')',
                    'type'=>Form::INPUT_WIDGET,
                    'widgetClass' => Select2::classname(),
                    'options' => [
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => false,
                        'options' => ['placeholder' => '-- Airport --',  'columnOptions'=>['colspan'=>3]],
                        'data'=>['1' => 'Maceo', '2' => 'Martí']
                    ]
                ],
            ],
            ]
    ];
?>
<?php

    Modal::begin([
        'header' => '<h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i>'.yii::t('app', 'New Owner').'</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modal-body'></div>";
    
    Modal::end();
?>
<?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'rows'=>$rows
    ]);
?>