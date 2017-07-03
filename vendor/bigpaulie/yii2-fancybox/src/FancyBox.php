<?php

/**
 * Yii2 FancyBox Extension 
 * @author Paul P <bigpaulie25ro@yahoo.com>
 * @license MIT
 */

namespace bigpaulie\fancybox;

use yii\helpers\Html;
use yii\web\View;
use bigpaulie\fancybox\FancyBoxAsset;
use bigpaulie\fancybox\Widget;

/**
 * FancyBox Widget
 * This is a single element widget 
 * @author Paul P <bigpaulie25ro@yahoo.com>
 */
class FancyBox extends Widget {

    public function init() {
        parent::init();

        if (!isset($this->htmlOptions['linkOptions']['id'])) {
            $this->htmlOptions['linkOptions']['id'] = $this->id;
        }

        $view = $this->getView();
        $this->registerScripts($view);
    }

    /**
     * Run the widget
     */
    public function run() {
        if ($this->type == "image") {
            /**
             * Add the fancybox image type css class
             */
            if (isset($this->htmlOptions['linkOptions']['class'])) {
                $class = $this->htmlOptions['linkOptions']['class'];
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.image ' . $class;
            } else {
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.image ';
            }
            /**
             * Output the HTML markup
             */
            echo Html::a(Html::img($this->item['src'], $this->htmlOptions['imageOptions']), $this->item['href'], $this->htmlOptions['linkOptions']);
        } elseif ($this->type == "inline") {
            /**
             * Add the fancybox inline type css class
             */
            if (isset($this->htmlOptions['linkOptions']['class'])) {
                $class = $this->htmlOptions['linkOptions']['class'];
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.inline ' . $class;
            } else {
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.inline ';
            }


            echo Html::a($this->item['text'], $this->item['href'], $this->htmlOptions['linkOptions']);
        } elseif ($this->type == "iframe") {
            /**
             * Add the facnybox iframe type css class 
             */
            if (isset($this->htmlOptions['linkOptions']['class'])) {
                $class = $this->htmlOptions['linkOptions']['class'];
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.iframe ' . $class;
            } else {
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.iframe ';
            }

            echo Html::a($this->item['text'], $this->item['href'], $this->htmlOptions['linkOptions']);
        } elseif ($this->type == "ajax") {
            /**
             * Add the fancybox ajax type css class
             */
            if (isset($this->htmlOptions['linkOptions']['class'])) {
                $class = $this->htmlOptions['linkOptions']['class'];
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.ajax ' . $class;
            } else {
                $this->htmlOptions['linkOptions']['class'] = 'fancybox.ajax ';
            }


            echo Html::a($this->item['text'], $this->item['href'], $this->htmlOptions['linkOptions']);
        } elseif ($this->type == "media") {
            /**
             * Add the fancybox media type css class
             */
            if (isset($this->htmlOptions['linkOptions']['class'])) {
                $class = $this->htmlOptions['linkOptions']['class'];
                $this->htmlOptions['linkOptions']['class'] = 'fancybox-media ' . $class;
            } else {
                $this->htmlOptions['linkOptions']['class'] = 'fancybox-media ';
            }


            echo Html::a($this->item['text'], $this->item['href'], $this->htmlOptions['linkOptions']);
        }
    }

}
