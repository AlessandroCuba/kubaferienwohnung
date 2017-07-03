<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HouseservicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houseservices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houseservices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Houseservices'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_service',
            'Denominations',
            'Description',
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
