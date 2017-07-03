<?php
use yii\widgets\LinkPager;

$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
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
                <div class="blog-page__content">
                    <!-- POST -->
                    <div class="post">
                    <?php
                        foreach($posts as $post)
                        {
                            echo $this->render('_brief', [
                                'data' => $post,
                            ]);
                        }
                    ?>
                    </div>
                    <!-- END / POST -->
                    <!-- PAGINATION -->
                    <div class="page__pagination">
                        <?= LinkPager::widget(['pagination' => $pagination]) ?>
                    </div>
                    <!-- END / PAGINATION -->
                </div>
            </div>
            <?= $this->render('sidebar'); ?>
        </div>
    </div>
</section>