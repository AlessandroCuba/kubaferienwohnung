<?php

use kartik\file\FileInput;

    echo $form->field($model, 'fotos[]')->widget(FileInput::classname(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'maxFileCount' => 10,
                    'initialPreview'=> $model->geturlImages(),
                    'initialPreviewConfig' => $model->getfotoData(),
                    'initialPreviewAsData'=> true,
                    'overwriteInitial'=>true,
                    'showCaption' => false,
                    'showRemove' => true,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-primary',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Photo',
                    //'fileActionSettings' => ['showRemove' => true],
                ],
                'pluginEvents' => [
                    /*'filepredelete' => "function(event, key) {
                        return (!confirm('Are you sure you want to delete ?')); 
                    }",
                    'filedelete' => 'function(delete, key) { '
                    .   ''
                    .   'console.log(\'File is delete\'); '
                    . '}',*/
                ]
        ])->label('Fotos (Máx. 10)');