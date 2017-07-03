<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class GofarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend/assets';
    public $css = [
        //<-- CSS LIBRARY -->
    	//'css/lib/bootstrap.min.css',
    	'css/lib/font-awesome.min.css',
    	'css/lib/awe-booking-font.css',
    	//'css/lib/owl.carousel.css',
    	'css/lib/magnific-popup.css',
        //'css/lib/jquery-ui.css',
        //<!-- REVOLUTION DEMO -->
    	'revslider-demo/css/settings.css',
		//<!-- MAIN STYLE -->
    	'css/style.css',
    	'css/demo.css',
    	//<!-- CSS COLOR -->
    	'css/colors/blue.css',
        // ===== Fonts ========
        'http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300',
        'http://fonts.googleapis.com/css?family=Oswald:400',
        'http://fonts.googleapis.com/css?family=Lato:400,700'
        
    ];
    public $js = [
    	//<!-- LOAD JQUERY -->
    	//'js/lib/jquery-1.11.2.min.js',
    	'js/lib/masonry.pkgd.min.js',
    	'js/lib/jquery.parallax-1.1.3.js',
    	//'js/lib/jquery.owl.carousel.js',
    	'js/lib/theia-sticky-sidebar.js',
    	'js/lib/jquery.magnific-popup.min.js',
    	'js/lib/jquery-ui.js',
    	'js/scripts.js',
        'js/revolution.js',
        'https://maps.googleapis.com/maps/api/js?v=3',

    	//<!-- REVOLUTION DEMO -->
    	'revslider-demo/js/jquery.themepunch.revolution.min.js',
    	'revslider-demo/js/jquery.themepunch.tools.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
