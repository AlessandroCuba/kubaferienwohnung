 <?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houses');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

<!-- HEADING PAGE -->
<section class="awe-parallax category-heading-section-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="category-heading-content category-heading-content__2 text-uppercase">
        <!-- BREADCRUMB -->
            <div class="breadcrumb">
                <?= $this->params['breadcrumbs'][] = $this->title; ?>
            </div>
            <!-- BREADCRUMB -->
            <div class="find">
                <h2 class="text-center"><?= yii::t('app', 'Find your House')?></h2>
            </div>
        </div>
    </div>
</section>
<!-- END / HEADING PAGE -->
<?php Pjax::begin(); ?>
<section class="filter-page">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="page-top">
                <div class="your-destinations__bar">
                    <div class="view-switcher">
                        <div class="view-item">
                            <a href="index">
                                <i class="awe-icon awe-icon-list"></i>
                            </a>
                        </div>
                        <div class="view-item view-active">
                            <a href="grid">
                                <i class="awe-icon awe-icon-grid"></i>
                            </a>
                        </div>
                    </div>
                    <div class="order">
                        <select class="orderby awe-select">
                            <option>Best Match</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-md-push-3">
            <div class="filter-page__content">
                <div class="filter-item-wrapper">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'region',
                            'value' => 'region.regionName',
                        ],
                        [
                            'attribute' => 'province',
                            'value' => 'region.province.provinceName'
                        ],
                        'houseName',
                        // 'houseAdresse:ntext',
                        // 'houseCapacity',
                         'houseRating',
                        //'housePriceLow',
                        // 'housePriceHigh',
                        // 'houseStatus',
                        // 'houseFlag',
                        // 'houseCreatedAt',
                        // 'houseUpdateAt',
                        // 'services:ntext',
                        // 'facilities:ntext',
                        // 'houseFotos:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                </div>
            </div>
        </div>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
</section>
<?php Pjax::end(); ?>    
