<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RoomfacilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roomfacilities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomfacility-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Roomfacility'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_facility',
            'Denominations',
            'Description',
            [
                'attribute' => 'destination',
                'value' => function ($data){
                                if($data->destination == 1){
                                    return 'en Casa';
                                }
                                elseif ($data->destination == 2){
                                    return 'en Habitación';   
                                } 
                                else{
                                    return 'Casa o Habitación';   
                                }
                },
                'filter' => array('1' => 'Casa', '2' => 'Habitación', '3' => 'Casa o Habitación'),
            ],
            [
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function ($data){
                                return Html::img(Yii::getAlias('@imgIconsSet').'/'.$data->foto.'.svg', ['class'=>'img-thumbnail','style'=>'max-width:50px;']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
