<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use kartik\widgets\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = $model->houseName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            [
                'attribute' => 'idRegion',
                'value' => $model->region->regionName,
            ],
            [
                'attribute' => 'idOwner',
                'value' => $model->owner->ownerName.' '.$model->owner->ownerLastName,
            ],
            /*[
                'attribute'=> 'services',
                'format'=> 'raw',
                'value'=> $model->geticonsSet()
            ],*/
            'houseName',
            [
                'attribute'=> 'houseFotos',
                'format'=> 'raw',
                'value'=> $model->getphotosViewer()
            ],
            [
                'attribute' => 'houseDescription',
                'format' => 'html',
            ],
            'houseAdresse',
            //'houseCapacity',
            'houseRating',
            //'housePriceLow',
            //'housePriceHigh',
            'houseStatus',
            'houseFlag',
            'houseRating',
            [
                'attribute' => 'houseCreatedAt',
                'value' => date('F j, Y, G:i', $model->houseCreatedAt),
            ],
            [
                'attribute' => 'houseUpdateAt',
                'value' => date('F j, Y, G:i', $model->houseUpdateAt),
            ],
        ],
    ]) ?>
        
    <?php/*= GridView::widget([
    'dataProvider' => $model->getroomList(),
        'columns' => [
            'idroom',
            'roomCapacity',
            'roomDimension',
        ],
    ]) */?>
 
    <?php echo StarRating::widget([
                'model' => $model,
                'name' => 'houseRating',
                'pluginOptions' => ['showClear'=>false]
                ]);
    ?>
    
    
</div>
