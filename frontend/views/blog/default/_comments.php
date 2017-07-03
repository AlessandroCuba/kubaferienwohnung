<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>

<!--
<div class="commentlist-wrapper">
        <ul class="commentlist">
            <li class="comment">
                <div class="comment-box">
                    <div class="comment-author">
                        <a href="#"><img src="images/img/demo-thumb.jpg" alt=""></a>
                    </div>
                    <div class="comment-body">
                        <cite class="fn"><a href="#">Gofar</a></cite>
                        <p>Mauris tincidunt, quam at feugiat efficitur, justo nunc efficitur justo, a hendrerit lectus neque eu nibh. Praesent eu sem erat. Fusce non sagittis lorem.</p>
                        <div class="comment-meta">
                            <span>5 days ago</span>
                        </div>
                        <div class="comment-abs">
                            <a href="#" class="comment-edit-link">Edit</a> // 
                            <a href="#" class="comment-reply-link">Reply</a>
                        </div>
                    </div>
                </div>
                <ul class="children">
                    <li class="comment bypostauthor">
                        <div class="comment-box">
                            <div class="comment-author">
                                <a href="#"><img src="images/img/demo-thumb.jpg" alt=""></a>
                            </div>
                            <div class="comment-body">
                                <cite class="fn">
                                    <a href="#">Gofar</a>
                                    <span class="byauthor">Author</span>
                                </cite>
                                <p>Aliquam volutpat elit non urna faucibus condimentum. Pellentesque nibh libero, consequat at nibh a, tincidunt rutrum magna. Curabitur in posuere risus, dictum euismod dolor. Vestibulum auctor orci sed elit ultricies tempus. Praesent facilisis tellus turpis, ac congue lorem consectetur ac.</p>
                                <div class="comment-meta">
                                    <span>5 days ago</span>
                                </div>
                                <div class="comment-abs">
                                    <a href="#" class="comment-edit-link">Edit</a> // 
                                    <a href="#" class="comment-reply-link">Reply</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
-->






<?php foreach($comments as $comment){ ?>
    <div class="comment" id="c<?= $comment->id; ?>">

        <div class="author">
            <?= Html::a("#{$comment->id}", $comment->getUrl($post), [
                'class' => 'cid',
                'title' => \funson86\blog\Module::t('blog', 'Permalink to this comment'),
            ]); ?>
            <?= $comment->authorLink; ?>&nbsp;<span><?= Yii::$app->formatter->asDate($comment->created_at); ?>
        </div>

        <div class="content">
            <?= nl2br(Html::encode($comment->content)); ?>
        </div>

    </div><!-- comment -->
<?php } ?>
