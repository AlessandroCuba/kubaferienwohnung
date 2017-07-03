<?php 
use funson86\blog\widgets\Search;
use funson86\blog\widgets\TagCloud;
use funson86\blog\widgets\RecentPosts;
use funson86\blog\widgets\SiteStat;
use funson86\blog\widgets\HotPosts;
?>

<div class="col-md-3">
    <div class="page-sidebar">
    <!-- WIDGET -->
        <div class="widget widget_search">
            <?= Search::widget() ?>
        </div>
                    <!-- END / WIDGET -->
                    <!-- WIDGET -->
                    <div class="widget widget_follow_us">
                        <h3>Follow us</h3>
                        <div class="awe-social">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- END / WIDGET -->
                    <!-- WIDGET -->
                    <div class="widget widget_categories">
                        <?= HotPosts::widget([
                            'title' => 'Most read',
                            'maxPosts' => 5,
                        ]) ?>
                    </div>
                    <!-- END / WIDGET -->
                    <!-- WIDGET -->
                    <div class="widget widget_has_thumbnail">
                        <?= RecentPosts::widget([
                            'title' => 'Recent Posts',
                            'maxPosts' => 5,
                        ]) ?>
                    </div>
                    <!-- END / WIDGET -->
                    <!-- WIDGET -->
                    <div class="widget widget_tag_cloud">
                        <h3>Tags</h3>
                        <div class="tagcloud">
                            <?= TagCloud::widget([
                                'title' => false,
                                'maxTags' => 10,
                            ]) ?>
                        </div>
                    </div>
                    <!-- END / WIDGET -->
                    <!-- WIDGET -->
                    <div class="widget widget_sitestat">
                        <h3>Stat</h3>
                        <div class="tagcloud">
                            <?= SiteStat::widget([
                                'title' => '<i class="icon-st"></i>网站统计',
                            ]) ?>
                        </div>
                    </div>
                    <!-- END / WIDGET -->
                </div>
            </div>