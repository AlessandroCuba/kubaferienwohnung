# yii2-fancybox
Yii2 FancyBox 2 extension

FancyBox is a tool that offers a nice and elegant way to add zooming functionality 
for images, html content and multi-media on your webpages. 
It is built on the top of the popular JavaScript framework jQuery and is 
both easy to implement and a snap to customize. 

Form more information on how to use FancyBox please go to their website http://fancyapps.com/fancybox/

## Install

The preferred way of installing is through composer
```
    composer require --prefer-dist bigpaulie/yii2-fancybox "dev-master"
```

OR add to composer.json
```
    "bigpaulie/yii2-fancybox": "dev-master"
```


## Example usage :

```php
    use bigpaulie\fancybox\FancyBox;
```

### Images
```php
    echo FancyBox::widget([
        'type' => 'image',
        'item' => [
            'href' => 'url_to_thumbnail',
            'src' => 'url_to_big_image',
        ],
    ]);
```
### Inline content
```php
    echo FancyBox::widget([
        'type' => 'inline',
        'item' => [
            'href' => '#myInline',
            'text' => 'click here',
        ],
    ]);
```
```html
    <div style="display:none;"><p id="#myInline">This is my inline content !</p></div>
```
### Ajax
```php
    echo FancyBox::widget([
        'type' => 'ajax',
        'item' => [
            'href' => 'http://example.com/ajax.php',
            'text' => 'click here',
        ],
    ]);
```

#### OR

```php
    echo FancyBox::widget([
        'type' => 'ajax',
        'item' => [
            'href' => Url::to(['site/ajax']),
            'text' => 'click here',
        ],
    ]);
```
### Media
```php
    echo FancyBox::widget([
        'type' => 'media',
        'item' => [
            'href' => 'https://www.youtube.com/watch?v=YE7VzlLtp-4',
            'text' => 'click here',
        ],
        'clientOptions' => [
            'helpers' => [
                'media' => true,
            ],
        ],
    ]);
```
