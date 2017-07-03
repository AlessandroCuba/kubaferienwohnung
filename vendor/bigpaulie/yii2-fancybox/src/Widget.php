<?php
/**
 * Yii2 FancyBox Extension 
 * @author Paul P <bigpaulie25ro@yahoo.com>
 * @license MIT
 */
namespace bigpaulie\fancybox;

use yii\helpers\Json;
use yii\web\View;

class Widget extends \yii\base\Widget {
    
    public $item;
    public $type = 'image';
    public $htmlOptions = [
        'linkOptions' => [],
        'imageOptions' => [],
    ];
    public $clientOptions = [];

    public function init() {
        
        /**
         * Assign the widgte id
         */
        if (empty($this->id)) {
            $this->id = $this->getId();
        }
        
        // Register the asset bundle
        $view = $this->getView();
        FancyBoxAsset::register($view);

    }
    
    /**
     * Register scripts
     * @param View $view
     */
    protected function registerScripts(\yii\web\View $view){
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "jQuery('#{$this->id}').fancybox($options);";
            $view->registerJs($js , View::POS_READY);
        }
    }
    
}
