<?php
/**
 * Yii2 FancyBox Extension 
 * @author Paul P <bigpaulie25ro@yahoo.com>
 * @license MIT
 */
namespace bigpaulie\fancybox;

use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle{
    
    public $sourcePath = '@bower/fancybox';
    
    public $css = [
        'source/jquery.fancybox.css',
        'source/helpers/jquery.fancybox-buttons.css',
        'source/helpers/jquery.fancybox-thumbs.css',
    ];
    
    public $js = [
        'source/jquery.fancybox.js',
        'lib/jquery.mousewheel-3.0.6.pack.js',
        'source/helpers/jquery.fancybox-buttons.js',
        'source/helpers/jquery.fancybox-thumbs.js',
        'source/helpers/jquery.fancybox-media.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    
}
