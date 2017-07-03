<?php

/**
 * Yii2 FancyBox Gallery Widget
 * @author Paul P <bigpaulie25ro@yahoo.com>
 * @see http://fancyapps.com/fancybox/#docs
 */

namespace bigpaulie\fancybox;

use bigpaulie\fancybox\Widget;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Json;

/**
 * Fancybox Gallery Widget
 */
class FancyGallery extends Widget {

    /**
     * Container tag
     * @var string 
     */
    public $tag = 'ul';

    /**
     * Array of items 
     * @var array
     */
    public $items;

    /**
     * Items template
     * @var string
     */
    public $template = '<li>{item}</li>';

    /**
     * Html Options
     * @var string
     */
    public $htmlOptions = [
        'linkOptions' => [],
        'thumbnailOptions' => [],
        'containerOptions' => [],
    ];

    /**
     * @inheritDoc
     */
    public function init() {
        parent::init();
        $this->registerScripts($this->getView());

        /**
         * Check if a css class has been assigned to the element
         * if not add the fancybox and fancybox.image class
         * else append the default classes to the user inputed 
         */
        if (isset($this->htmlOptions['linkOptions']['class'])) {
            $class = $this->htmlOptions['linkOptions']['class'];
            $this->htmlOptions['linkOptions']['class'] = 'fancybox bancybox.image ' . $class;
        } else {
            $this->htmlOptions['linkOptions']['class'] = 'fancybox bancybox.image ';
        }

        /**
         * Check if a css class has been assigned to the element
         * if not assign by default a boostrap class
         */
        if (!isset($this->htmlOptions['thumbnailOptions']['class'])) {
            $this->htmlOptions['thumbnailOptions']['class'] = 'img-thumbnail';
        }

        /**
         * Check if a group has been assigned to the gallery
         * if not assign the default auto generated id of the widget
         */
        if (!isset($this->htmlOptions['linkOptions']['data-group-fancybox'])) {
            $this->htmlOptions['linkOptions']['data-fancybox-group'] = $this->id;
        }
    }

    /**
     * Run the widget
     */
    public function run() {
        echo Html::beginTag($this->tag, $this->htmlOptions['containerOptions']);
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                echo $this->parseTemplate($item);
            }
        }
        echo Html::endTag($this->tag);
    }

    /**
     * Parse template
     * @param array $item
     * @return string
     */
    protected function parseTemplate(array $item) {
        /**
         * Check if a title has been assigned to the element
         */
        if (isset($item['title'])) {
            $this->htmlOptions['linkOptions']['title'] = $item['title'];
        }
        /**
         * Parse the template
         */
        $replace = Html::a(Html::img($item['src'], $this->htmlOptions['thumbnailOptions']), $item['href'], $this->htmlOptions['linkOptions']);
        $template = str_replace('{item}', $replace, $this->template);
        return $template;
    }

    /**
     * @inheritDoc
     */
    protected function registerScripts(\yii\web\View $view) {
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "jQuery('.fancybox').fancybox($options);";
            $view->registerJs($js, View::POS_READY);
        } else {
            $js = "jQuery('.fancybox').fancybox();";
            $view->registerJs($js, View::POS_READY);
        }
    }

}
