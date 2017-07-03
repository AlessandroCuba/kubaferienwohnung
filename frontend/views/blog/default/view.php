<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use funson86\blog\Module;

$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->catalog->title => Yii::app()->createUrl('post/catalog', array('id'=>$post->catalog->id, 'surname'=>$post->catalog->surname)),
    '文章',
];*/

?>
<!-- HEADING PAGE -->
<section class="awe-parallax page-heading-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="blog-heading-content text-uppercase">
            <h2>TRAVEL BLOG</h2>
        </div>
    </div>
</section>
<!-- END / HEADING PAGE -->
<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-page__content blog-single">
                    <!-- POST -->
                    <?php
                        echo $this->render('_view', [
                            'data' => $post,
                        ]);
                    ?>
                    <!-- END / POST -->
                    <!-- ABOUT AUTHOR -->
                    <div class="about-author">
                        <div class="image-thumb fl">
                            <div class="image-cover">
                                <img src="images/img/1.jpg" alt="">
                            </div>
                        </div>
                        <div class="author-info">
                            <div class="author-title">
                                <h4>About author</h4>
                            </div>
                            <div class="author-name">
                                <h3>Name of author</h3>
                            </div>
                            <div class="author-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet nulla sed venenatis vulputate. Nulla venenatis mi sed fermentum laoreet.</p>
                            </div>
                            <div class="author-social">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- END / ABOUT AUTHOR -->
                    <!-- RELATED POSTS -->
                    <!-- END / RELATED POSTS -->
                    <!-- COMMENTS -->
                    <?= $this->render('_form', [
                        'model' => $comment,
                        'post'=> $post
                    ]);?>
                    
                    <?php if($post->commentsCount >= 1): ?>
                        <h3>
                            <?= $post->commentsCount . Module::t('blog', 'Unit comments'); ?>
                        </h3>

                        <?=$this->render('_comments',array(
                            'post' => $post,
                            'comments' => $comments,
                        )); ?>
                        <?php endif; ?>
                    <!-- END / COMMENTS -->
                </div>
            </div>
            <!-- SIDEBAR -->
            <?= $this->render('sidebar'); ?>
            <!-- END / SIDEBAR -->
        </div>
    </div>
</section>
