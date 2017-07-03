<?php
use yii\helpers\Html;
?>
<h3><?= Yii::t('app', $title)?></h3>
<ul>
    <?php foreach($posts as $post): ?>
    <div class="content">
        <?php echo Html::a(Html::encode($post->title), $post->getUrl()).' (Read: '.$post->click.')'; ?>
    </div>
    <?php endforeach; ?>
</ul>