<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\House */

$this->title = $model->houseName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="sidebar">
            <div class="box filter">
                <h3>Search Form </h3>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) 
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <div class="quick-navigation" data-fixed-after-touch="" style="height: 34px;">
            <div class="wrapper" style="width: 848px;">
                <ul>
                    <li id="menu-item-82" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-82">
                        <a href="#description" class="scroll">Description</a>
                    </li>
                    <li id="menu-item-83" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83">
                        <a href="#facility" class="scroll">Facilities</a>
                    </li>
                    <li id="menu-item-83" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83">
                        <a href="#availability" class="scroll">Services</a>
                    </li>
                    <li id="menu-item-83" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83">
                        <a href="#availability" class="scroll">Availability</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-container">
            <div class="title">
                <div class="left"></div>
                <h1><?=$model->houseName ?><span class="rating">
                        <i class="glyphicon glyphicon-star-empty"><?= $model->houseRating ?></i></span>
                </h1>
                <h4><a><?= $model->region->regionName ?></a></h4>
                <div class="right">
                    <a href="#map" class="icon scroll"><i class="glyphicon glyphicon-map-marker"></i>See on the map</a>
                    <a class="btn btn-primary btn-rounded scroll"><?= Yii::t('app', 'Reserve Today') ?></a> 
                </div>
            </div>
            <section id="gallery">
                <div class="gallery-detail">
                <div class="ribbon">
                    <div class="offer-number">20%</div>
                    <figure>Off Today!</figure>
                </div>
                <div class="images">
                    <?php echo $model->getphotosViewer(); ?>
                </div>
                </div>
            </section>
            <h2><?= yii::t('app','Description') ?></h2>
            <div class="row">
                <div class="col-md-8">
                    <section id="description"><?= $model->houseDescription ?></section>
                    <section id="facility"><h2>Facilities</h2><?php //= $model->geticonsSet($model->facilities) ?></section>
                    <section id="Services"><h2>Services</h2><?php //= $model->geticonsSet($model->services) ?></section>
                    <section id="map"><h2>Map</h2>Aca va el Mapa</section>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <aside class="box">
                            <dl>
                                <img class="img-circle" width="100" height="100" src="<?= Yii::getAlias('@imgAvatarsUrl').'/'.$model->owner->ownerAvatar ?>">
                                <h3>Owner:</h3><?php echo $model->owner->ownerName.' '.$model->owner->ownerLastName; ?>
                            </dl> 
                        </aside>
                    </div>
                </div>
            </div>
            <section id="availability">
                <h2>Availability</h2>
                <div class="form-reservations"><div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rooms Type</th>
                                <th>Persons</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>tipo</td>
                            <td>Personas</td>
                            <td>Precio</td>
                        </tr>
                    </table>    
                </div></div>
            </section>
        </div>
    </div>
</div>