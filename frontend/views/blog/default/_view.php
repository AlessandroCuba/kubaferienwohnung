<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use funson86\blog\widgets\TagCloud;
?>

<div class="post">
    <div class="post-meta">
        <div class="date"><?= Yii::$app->formatter->asDate($data->created_at); ?></div>
        <div class="author">by <a href="#"><?= $data->user->username; ?></a></div>
        <div class="cat">
            <ul>
                <li><?= '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?></li>
            </ul>
        </div>
        <div class="comment"><?= Html::a("{$data->commentsCount} Comments  &raquo;", $data->url.'#comments'); ?> &raquo;</div>
    </div>
    <div class="post-title">
        <h1><?= Html::encode($data->title); ?></h1>
    </div>
    <div class="post-media">
        <div class="image-wrap">
            <?php echo Html::a('<img src="'.yii::getAlias('@imgBlog').'/'.$data->banner.'" alt="">', $data->getUrl()); ?>
        </div>
    </div>
    <div class="post-body">
        <div class="post-content">
            <?php
                $parser = new \cebe\markdown\GithubMarkdown();
                echo $parser->parse($data->content);
            ?>
            <div class="shortcode-tour-map">
                <div class="shortcode-tour-map__map">
                    
                </div>
                <div class="shortcode-tour-map__content">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="post-footer">
        <div class="share-box">
            <h4>Share</h4>
            <div class="share">
                <a href="#">
                    <i class="fa fa-twitter"></i><span class="count">2</span>
                </a>
                <a href="#">
                    <i class="fa fa-pinterest"></i><span class="count">43</span>
                </a>
                <a href="#">
                    <i class="fa fa-facebook"></i><span class="count">124</span>
                </a>
                <a href="#">
                    <i class="fa fa-google-plus"></i><span class="count">1.8k</span>
                </a>
            </div>
        </div>
        <div class="tag-box">
            <h4>Tag</h4>
            <div class="tag">
                <?= TagCloud::widget([
                    'title' => false,
                    'maxTags' => 10,
                ]) ?>
            </div>
        </div>
        <div class="cat-box">
            <h4>Category</h4>
            <div class="cat">
                <?= '<a href="'. Yii::$app->getUrlManager()->createUrl(['/post/catalog/','id'=>$data->catalog->id]) .'">' . $data->catalog->title . '</a>'; ?>
            </div>
        </div>
    </div>
</div>