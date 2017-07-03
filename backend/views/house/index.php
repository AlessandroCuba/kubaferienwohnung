<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houses');
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">House List</h3>
            </div>
            <div class="row">
                <div class="col-sm-10">
                </div>
                <div class="col-sm-2">
                    <div class="dataTables_filter">
                        <?= Html::a(Yii::t('app', 'Create House'), ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                        'attribute' => 'idRegion',
                        'value' => function ($data){
                                    return $data->region->regionName;
                                    }
                        ],
                            [
                                'attribute' => 'idOwner',
                                'value' => function ($data){
                                                return $data->owner->ownerName.' '.$data->owner->ownerLastName;
                                            }
                            ],
                            'houseName',
                            'houseRating',
                            'houseStatus',
                            'houseFlag',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    
                    <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
</div>