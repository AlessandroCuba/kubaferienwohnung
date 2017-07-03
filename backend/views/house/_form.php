<?php

use yii\helpers\Html;

use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;

use v0lume\yii2\metaTags\MetaTags;

/* @var $this yii\web\View */
/* @var $model common\models\House */
/* @var $form yii\widgets\ActiveForm */

?>
    <?php
    
        $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'type'=>ActiveForm::TYPE_VERTICAL,
            'options' => ['enctype' => 'multipart/form-data']
        ]); 
    ?>      

    <?php
        echo $form->errorSummary($model);
        
        $items = [
            [
            'label' => '<i class="glyphicon glyphicon-home"></i> Home Detail',
            'content' => $this->render('form/_formDetail', ['model' => $model, 'form' => $form]),
            'active' => true
            ],
            [
            'label' => '<i class="glyphicon glyphicon-camera"></i> Photos',
            'content' => $this->render('form/_formFotos', ['model' => $model, 'form' => $form]),
            ],
            [
            'label' => '<i class="glyphicon glyphicon-bed"></i> Rooms',
            'content' => $this->render('form/_formRooms', ['model'=>$model, 'modelsRooms' => $modelsRooms, 'form' => $form]),
            ]
        ] 
    ?>
    
    <?= TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
            //'containerOptions' => ''
        ]);
    ?>
</div>
    
<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
    ]) ?>
</div>

</div>
<!-- div col-md-9 -->
</div>
<div class="col-md-3">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Meta-tags</h3>
        </div>
        <div class="box-body">
        <?php 
            echo MetaTags::widget([
                'model' => $model,
                'form' => $form
            ]);
        ?>
        </div>
    </div>
</div>
<!-- /.box -->
<div class="col-md-3">
<!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Meta-tags</h3>
        </div>
        <div class="box-body">
        <?php
        
            echo $form->field($model, 'latitud')->textInput();
            echo $form->field($model, 'longitud')->textInput();
            echo $form->field($model, 'coordenadas')->textInput();
            
        ?>
        </div>
    </div>
</div>
<!-- /.box -->
<?php ActiveForm::end(); ?>
</div>
<!-- row -->
</div>

