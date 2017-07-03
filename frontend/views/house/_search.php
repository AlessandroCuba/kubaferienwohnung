<?php
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Province;
use common\models\Region;
use common\models\Facilities;

use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
use kartik\money\MaskMoney;
?>

<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); 
?>
<div class="col-md-3 col-md-pull-9">
    <div class="page-sidebar">
        <div class="sidebar-title">
            <h2>Houses filter</h2>
        </div>
        <div class="widget widget_has_radio_checkbox">
            <h3>Location</h3>
            <?= $form->field($model, 'province')->widget(Select2::classname(), [
                    //'id' => 'idProvince',
                    'data' => ArrayHelper::map(Province::find()->orderBy('id_province')->asArray()->all(), 'id_province', 'provinceName'),
                    'options' => ['placeholder' => 'Select a province ...'],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false);
            ?>
            
            <?= $form->field($model, 'idRegion')->widget(DepDrop::classname(), [
                'options' => ['id'=>'region-id'],
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' => ['housesearch-province'],
                    'placeholder' => 'Select Region...',
                    'url' => Url::to(['/house/region'])
                ]
            ])->label(false);
            ?>
            
        </div>
        <div class="widget widget_price_filter">
            <h3>Date</h3>
            <div class="price-slider-wrapper">
                <?= $form->field($model, 'dateFrom')->widget(DatePicker::className(), [
                        //'value' => $model->date_from,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ])->label(false);?>    
                <?= $form->field($model, 'dateTo')->widget(DatePicker::className(), [
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ])->label(false);?>    
            </div>
        </div>
        <div class="widget widget_has_radio_checkbox">
            <h3>Guest</h3>
            <div class="price-slider-wrapper">
                <?= $form->field($model, 'roomCapacity')->label(false) ?>
            </div>    
        </div>
        <div class="widget widget_price_filter">
            <div class="price-slider-wrapper">
                <?php echo FieldRange::widget([
                    'form' => $form,
                    'model' => $model,
                    'separator' => '&larr; to &rarr;',
                    //'separatorOptions' => ['class' => 'separator'],
                    'label' => '<h3>Price</h3>',
                    'attribute1' => 'lowPrice',
                    'attribute2' => 'highPrice',
                    //'type' => FieldRange::INPUT_MONEY,
                ]);
                ?>
            </div>
        </div>
        <div class="widget widget_has_radio_checkbox">
            
        </div>
        <div class="widget widget_has_radio_checkbox">
            <?php $listData = ArrayHelper::map(Facilities::find()->all(), 'id_facility', 'Denominations')?>
            <ul>
            <?= $form->field($model, 'facilities')->CheckboxList(
                $listData, 
                ['item' => function ($index, $label, $name, $checked, $value) {
                            $checked = $checked ? 'checked' : '';
                            return  '<li>'
                                    .'<label>'
                                    .'<input type="checkbox" name='.$name.' value='.$value.' '.$checked.'>'
                                    .'<i class="awe-icon awe-icon-check"></i>'.$label
                                    .'</label>'
                                    .'</li>';
                           },
                ])->label('<h3>Check Service Include</h3>');
            ?>
            </ul>
        </div>
        <div class="widget widget_product_tag_cloud">
            <h3>Tags</h3>
            <div class="tagcloud">
                <a href="#">Hotel</a>
                <a href="#">Motel</a>
                <a href="#">Hostel</a>
                <a href="#">Homestay</a>
            </div>
        </div>
        <div class="widget">
            <div class="form-actions">
            <?= Html::resetButton(Yii::t('app', 'Clear all'), ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            </div>    
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>