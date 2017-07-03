<?php
use yii\helpers\Html;
use yii\helpers\Url;

use kartik\rating\StarRating;

//use common\models\Facilities;
use common\models\Room;
use common\models\House;

?>

<div class="item-media">
    <div class="image-cover">
        <?php echo $model->getphotosViewerAleatory()?>
    </div>
</div>
<div class="item-body">
    <div class="item-title">
        <h2><?= $model->houseName ?></h2>
    </div>
    <div class="item-hotel-star"><?php $model->getstarRating() ?></div>
    <div class="item-address"><i class="awe-icon awe-icon-marker-2"></i> <?= $model->region->regionName. ', '.$model->region->province->provinceName ?></div>
    <div class="item-footer">
        <div class="item-rate"><span><?= $model->houseRating ?></span></div>
        <div class="item-icon1">
            <?php  
                foreach ($model->facilities as $facilitiesItems){
                    echo '<i>'.Html::img(Yii::getAlias('@imgIconsSet').'/'.$facilitiesItems->foto.'.svg', ['class'=>'img-thumbnail','style'=>'max-width:35px;', 'alt'=>$facilitiesItems->foto]).'</i>';
                }
            ?>
        </div>
    </div>
</div>
<div class="item-price-more">
    <div class="price">one night from<span class="amount">
        <?php 
            $roomArray = Room::find()->where(['houseId' => $model->id])->orderBy('idroom')->all();
            foreach ($roomArray as $room){
                echo 'ab '.$room->lowPrice;
            }
            ?>
        </span>
    </div>
    <?= Html::a('Book now', 
            Url::toRoute(['view', 'id' => $model->id]), 
            ['class' => 'awe-btn', 'title' => 'Book '.$model->houseName]
            )
    ?>
</div>