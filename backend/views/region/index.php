<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use common\models\Province;

use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Region'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_region',
            'regionName',
            [
                'attribute' => 'idProvince',
                'value' => 'province.provinceName',
                'filter' => Select2::widget([
                               'model' => $searchModel,
                               'attribute' => 'idProvince',
                               'data' => ArrayHelper::map(Province::find()->orderBy('id_province')->asArray()->all(), 'id_province', 'provinceName'),
                               'options' => ['placeholder' => 'Select a Province ...'],
                               'pluginOptions' => ['allowClear' => true],
                            ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
