<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>

<div class="post-media">
    <div class="image-wrap">
        <?php echo Html::a('<img src="'.yii::getAlias('@imgBlog').'/'.$data->banner.'" alt="">', $data->getUrl()); ?>
    </div>
</div>
<div class="post-body">
    <div class="post-meta">
        <div class="date"><?= Yii::$app->formatter->asDate($data->created_at); ?></div>
        <div class="author">by <a href="#"><?= $data->user->username; ?></a></div>
        <div class="cat">
            <ul>
                <li>
                    <?= '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?>
                </li>
            </ul>
        </div>
        <div class="comment">
            <?= Html::a("{$data->commentsCount} Comments  &raquo;", $data->url.'#comments'); ?>
        </div>
        <?php //visualiza cantidad deveces leido = $data->click; ?> 
    </div>
    <div class="post-title">
        <h2><?= Html::a(Html::encode($data->title), $data->url); ?></h2>
    </div>
    <div class="post-content">
        <?php
            $parser = new \cebe\markdown\GithubMarkdown();
            echo $parser->parse($data->content);
        ?>
    </div>
    <div class="post-link">
        <?= Html::a('Read more', $data->url, ['title'=>Html::encode($data->title), 'class' => 'awe-btn awe-btn-style2']); ?>
    </div>
</div>