<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = $model->id_house;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_house], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_house], [
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
            'id_house',
            'idRegion',
            'idOwner',
            'houseName',
            'houseDescription',
            'houseAdresse:ntext',
            'houseCapacity',
            'houseRating',
            'housePriceLow',
            'housePriceHigh',
            'houseStatus',
            'houseFlag',
            'houseCreatedAt',
            'houseUpdateAt',
            'services:ntext',
            'facilities:ntext',
            'houseFotos:ntext',
        ],
    ]) ?>

</div>
