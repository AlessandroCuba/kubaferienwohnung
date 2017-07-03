<?php 
    use wbraganca\dynamicform\DynamicFormWidget; 
    use kartik\widgets\Select2;
    use yii\helpers\Html;
?>

<?php //print_r($modelsRooms); die(); ?>

<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 8, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsRooms[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'idtype',
            'roomCapacity',
            'roomDimension',
            'roomPrice',
            'roomStatus',
            'roomfacilities',
            
        ],
    ]); 
?>
            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsRooms as $i => $modelroom): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><?=Yii::t('app', 'Rooms')?></h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> <?= yii::t('app', 'Add') ?></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i><?= yii::t('app', 'Delete') ?></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelroom->isNewRecord) {
                                echo Html::activeHiddenInput($modelroom, "[{$i}]idroom");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelroom, "[{$i}]typeId")->dropDownList($model->roomType, ['prompt'=>'Tipo de Habitación']) ?>                        
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelroom, "[{$i}]Adult")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelroom, "[{$i}]Children")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelroom, "[{$i}]roomDimension")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelroom, "[{$i}]lowPrice")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelroom, "[{$i}]highPrice")->textInput() ?>
                            </div>
                            <div class="col-sm-2">

                                <?= $form->field($modelroom, "[{$i}]roomStatus")->dropDownList([0=>'Libre', 1=>'Ocupada', 2=>'Fuera de Servicio'], ['prompt'=>'Status']) ?>   
                            </div>
                        </div>
                        <!-- .row -->
                        <?= $form->field($modelroom, "[{$i}]roomfacilities")->widget(Select2::classname(), [
                                'data' => $modelroom->getroomFacilities(),
                                'options' => ['placeholder' => 'Select a Facilities ...', 'multiple' => true],
                                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    //'maximumInputLength' => 10
                                ],
                            ])->label('Facilities'); 
                        ?>

                        <?= $form->field($modelroom, "[{$i}]Description")->textarea(array('rows'=>2,'cols'=>5)); ?>

                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>