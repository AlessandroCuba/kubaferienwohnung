<?php
use yii\helpers\Html;
?>

<h3><?= Yii::t('app', $title)?></h3>
<ul>
    <?php foreach($posts as $post): ?>
    <li>
        <div class="image-wrap image-cover">
            <?php echo Html::a('<img src="'.yii::getAlias('@imgBlog').'/'.$post->banner.'" alt="">', $post->getUrl()); ?>
        </div>
        <div class="content">
            <?php echo Html::a(Html::encode($post->title), $post->getUrl()); ?>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
