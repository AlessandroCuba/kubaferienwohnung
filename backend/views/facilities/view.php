<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Roomfacility */

$this->title = $model->id_facility;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roomfacilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomfacility-view">

    <h1>Room Services and Facilities</h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_facility], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_facility], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_facility',
            'Denominations',
            'Description',
            'destination',
            [
                'attribute' => 'foto',
                'format' => 'html',
                'value' => Html::img(Yii::getAlias('@imgIconsSet').'/'.$model->foto.'.svg', ['class'=>'img-thumbnail','style'=>'max-width:50px;']),
            ]
        ],
    ]) 
    ?>


</div>
