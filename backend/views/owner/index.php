<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Owners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Owner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_owner',
            'ownerName',
            'ownerLastName',
            'ownerTelef',
            'ownerPhone',
            // 'ownerEmail:email',
            // 'ownerPassword',
            // 'ownerAvatar',
            // 'ownerCreatedAt',
            // 'ownerUpdateAt',
            // 'idLanguage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
