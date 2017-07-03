<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\GofarAsset;
use common\widgets\Alert;
use yii\widgets\Menu;
use bizley\cookiemonster\CookieMonster;
use pceuropa\languageSelection\LanguageSelection;
use raoul2000\widget\scrollup\Scrollup;

//Google Anality
use cybercog\yii\googleanalytics\widgets\GATracking;

GofarAsset::register($this);
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- TITLE -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    
    
    <?php
    
    //Google Analitiy
    echo GATracking::widget([
            'trackingId' => 'UA-96130087-1',
            'trackingConfig' => [
                'name' => 'myTracker',
                'allowAnchor' => false,
            ],
            'omitScriptTag' => false,
            'debug' => true,
            'debugTrace' => true,
            'anonymizeIp' => true,
            'plugins' => [
                'linkid' => [
                    'cookieName' => '_ccli',
                    'duration' => 45,
                    'levels' => 5,
                ],
            ],
        ]) 
    ?>
    
<?php $this->head() ?>
</head>

<!--[if IE 7]> <body class="ie7 lt-ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 8]> <body class="ie8 lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]> <body class="ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
<?php $this->beginBody() ?>
    <!-- PAGE WRAP -->
    <div id="page-wrap">
        <!-- PRELOADER -->
        <div class="preloader"></div>
        <!-- END / PRELOADER -->

        <!-- HEADER PAGE -->
        <header id="header-page">
            <div class="header-page__inner">
                <div class="container">
                    <!-- LOGO -->
                    <div class="logo">
                        <a href="index.html"><img src="<?= yii::getAlias('@imgKuba').'/logo.png'?>" alt=""></a>
                    </div>
                    <!-- END / LOGO -->
                    <!-- NAVIGATION -->
                    <nav class="navigation awe-navigation" data-responsive="1200">
                        <?php
                            //Cuenta los productos en el carro
                            $itemsCount = Yii::$app->cart->getCount();   //\Yii::$app->cart->getCount();
                            
                            $items = [
                                ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'options' => ['class' => 'menu-item-has-children current-menu-parent']],
                                ['label' => Yii::t('app', 'Destination'), 'url' => ['/house'], 'options' => ['class' => 'menu-item-has-children'], 'items' => [
                                    ['label' => 'Pinar del Rio', 'url' => ['#']],
                                    ['label' => 'Havanna', 'url' => ['#']],
                                ]],
                                ['label' => 'Blog', 'url' => ['/blog'], 'options' => ['class' => 'menu-item-has-children']],
                                ['label' => Yii::t('app','About'), 'url' => ['/site/about'], 'options' => ['class' => 'menu-item-has-children']],
                                ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact'], 'options' => ['class' => 'menu-item-has-children']],
                                
                                !Yii::$app->user->isGuest ?
                                ['label' => Yii::t('app', 'Welcome').', <b>'.Yii::$app->user->identity->username.'</b>', 'url'=>'#' ,'options' => ['class' => 'menu-item-has-children'], 'items' => [
                                    ['label' => 'My Profile', 'url' => ['/user/settings/profile']],
                                    ['label' => 'Logout ( '.Yii::$app->user->identity->username.' )',
                                        'url' => ['/user/security/logout'],
                                        'template' => '<a href="{url}" data-method="post">{label}</a>',
                                        //'linkOptions' => ['data-method' => 'post']
                                    ],
                                    
                                ]]:
                                ['label' => Yii::t('app', 'Register'), 'url' => ['/user/register'], 'visible' => Yii::$app->user->isGuest],
                                ['label' => Yii::t('app', 'Login'), 'url' => ['/user/login'], 'visible' => Yii::$app->user->isGuest],
                                ['label' => '<span class="glyphicon glyphicon-heart"></span>', 'options' => [
                                    'class' => 'favorites-menu clickable', 'style' => 'cursor: pointer;'], 
                                    'url' => false, 'visible' => !Yii::$app->user->isGuest, 'items' => ['' => '']
                                ],
                                [
                                    'label' => '<i class= "awe-icon awe-icon-cart"></i>'.($itemsCount ? " ($itemsCount)" : ''), 
                                    'url' => ['/cart/list']
                                ],
                                ];
                            
                            echo Menu::widget([
                                'options' => [
                                    'class' => 'menu-list',  //'sf-menu sf-js-enabled sf-arrows navbar-nav',
                                    //'id' => 'fh5co-primary-menu'
                                ], 
                                'items' =>  $items,
                                'submenuTemplate' => "\n<ul class='sub-menu'>\n{items}\n</ul>\n",
                                'encodeLabels' => false
                            ]);
                            
                            $this->registerJs("
                                $('.favorites-menu').click(function() {
                                    $.getJSON('".Url::to(['//favorites/favorites/json'])."', function (data) {
                                        dd = $('.favorites-menu').find('.dropdown-menu');
                                        dd.html('');
                                        dd.append('<li><a href=\"".Url::to(['//favorites/favorites/index'])."\">Manage favorites</a></li>');
                                        data.forEach(function(elem) {
                                          dd.append('<li>' + (elem.icon ? elem.icon : '') + ' <a href=\"' + elem.url + '\">' + elem.title.substring(0, 60) + '</a></li>');
                                         });
                                    });
                                });
                            ");
                        ?>
                    </nav>
                    <!-- END / NAVIGATION -->
                    <!-- LANGUAGE SELECT -->
                    <nav class="awe-navigation-language" data-responsive="1100">
                        <?= LanguageSelection::widget([
                                'language' => ['es', 'en', 'fr', 'nl', 'de'],
                                'languageParam' => 'language',
                                'container' => 'div', // li for navbar, div for sidebar or footer example
                                //'classContainer' =>  'dropbtn' // btn btn-default dropdown-toggle
                        ]);?>
                    </nav>
                    <!-- END / LANGUAGE SELECT -->
                    <!-- TOGGLE MENU RESPONSIVE -->
                    <a class="toggle-menu-responsive" href="#">
                        <div class="hamburger">
                            <span class="item item-1"></span>
                            <span class="item item-2"></span>
                            <span class="item item-3"></span>
                        </div>
                    </a>
                    <!-- END / TOGGLE MENU RESPONSIVE -->

                </div>
            </div>
        </header>
        <!-- END / HEADER PAGE -->                        
        <?= Alert::widget() ?>
        <?= $content ?>
        <!-- FOOTER PAGE -->
        <footer id="footer-page">
            <div class="container">
                <div class="row">
                    <!-- WIDGET -->
                    <div class="col-md-3">
                        <div class="widget widget_contact_info">
                            <div class="widget_background">
                                <div class="widget_background__half">
                                    <div class="bg"></div>
                                </div>
                                <div class="widget_background__half">
                                    <div class="bg"></div>
                                </div>
                            </div>
                            <div class="logo">
                                <img src="images/logo-footer.png" alt="">
                            </div>
                            <div class="widget_content">
                                <p>25 California Avenue, Santa Monica, California. USA</p>
                                <p>+1-888-8765-1234</p>
                                <a href="#">contact@gofar.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_about_us">
                            <h3>About Us</h3>
                            <div class="widget_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel dignissim dolor. Ut risus orci, aliquam sit amet semper eget, egestas aliquam felis.</p>
                            </div>
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_categories">
                            <h3>Categiries</h3>
                            <ul>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Regions</a></li>
                                <li><a href="#">Cities</a></li>
                                <li><a href="#">Districts</a></li>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Airports</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Places of interest</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-2">
                        <div class="widget widget_recent_entries">
                            <h3>Recent Blog</h3>
                            <ul>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Regions</a></li>
                                <li><a href="#">Cities</a></li>
                                <li><a href="#">Districts</a></li>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Airports</a></li>
                                <li><a href="#">Hotels</a></li>
                                <li><a href="#">Places of interest</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END / WIDGET -->

                    <!-- WIDGET -->
                    <div class="col-md-3">
                        <div class="widget widget_follow_us">
                            <div class="widget_content">
                                <p>For Special booking request, please call</p>
                                <span class="phone">099-099-000</span>
                                <div class="awe-social">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / WIDGET -->
                </div>
                <div class="copyright">
                    <p>©2015 GOFAR travel™ All rights reserved.</p>
                </div>
            </div>
        </footer>
        <!-- END / FOOTER PAGE -->
    </div>
    <!-- END / PAGE WRAP -->
    <!-- LOAD JQUERY -->

<?= CookieMonster::widget([
    'content' => [
        'buttonMessage' => 'OK', // instead of default 'I understand'
    ],
    'mode' => 'bottom'
]); ?>
    
<?= Scrollup::widget([
	'theme' => Scrollup::THEME_IMAGE,
	'pluginOptions' => [
		'scrollText' => "To top", // Text for element
		'scrollName'=> 'scrollUp', // Element ID
		'topDistance'=> 400, // Distance from top before showing element (px)
		'topSpeed'=> 3000, // Speed back to top (ms)
		'animation' => Scrollup::ANIMATION_SLIDE, // Fade, slide, none
		'animationInSpeed' => 200, // Animation in speed (ms)
		'animationOutSpeed'=> 200, // Animation out speed (ms)
		'activeOverlay' => false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	]
]);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>