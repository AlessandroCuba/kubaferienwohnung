<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Houseservices */

$this->title = $model->id_houseservice;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houseservices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houseservices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_houseservice], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_houseservice], [
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
            'id_houseservice',
            'Denominations',
            'Description',
            [
                'attribute' => 'foto',
                'format' => 'html',
                'value' => Html::img(Yii::getAlias('@imgIconsSet').'/'.$model->foto.'.svg', ['class'=>'img-thumbnail','style'=>'max-width:50px;']),
            ]
        ],
    ]) ?>

</div>
