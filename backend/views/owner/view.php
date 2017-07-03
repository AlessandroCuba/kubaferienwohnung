<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Owner */

$this->title = $model->ownerName.' '.$model->ownerLastName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    
    <div class="panel-body">
    <div class="col-md-3 col-lg-3 " align="center">
        <?php
        if(empty($model->ownerAvatar)){
            echo '<div><img class="img-circle" width="150" height="150" src="'.Yii::getAlias('@imgAvatarsUrl').'/nobody_m.original.jpg"></div> <br>'; 
        }else{
            echo '<div><img class="img-circle" width="150" height="150" src="'.Yii::getAlias('@imgAvatarsUrl').'/'.$model->ownerAvatar.'"></div> <br>'; 
        }
        ?>
    </div>
    
    <div class="col-md-9 col-lg-9"> 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_owner',
            'ownerName',
            'ownerLastName',
            [
                'attribute' => 'ownerBirthday',
                'value' => $model->ownerBirthday,
            ],
            'ownerTelef',
            'ownerPhone',
            'ownerEmail:email',
            'ownerPassword',
            [
                'attribute' => 'ownerCreatedAt',
                'value' => date('F j, Y, G:i', $model->ownerCreatedAt),
            ],
            [
                'attribute' => 'ownerUpdateAt',
                'value' => date('F j, Y, G:i', $model->ownerUpdateAt),
            ],
            'idLanguage',
        ],
    ]) ?>
        
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Add House'), ['/house/create', 'ownerid' => $model->id_owner], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_owner], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_owner], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        
    </div></div></div>
