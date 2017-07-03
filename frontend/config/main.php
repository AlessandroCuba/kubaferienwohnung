<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'defaultRoute' => 'blog', //set blog as default route
    'modules' => [
        'blog' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\frontend'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'modelMap' => [
                'RegistrationForm' => 'common\models\RegistrationForm',
                //'identityClass' => 'common\models\RegistrationForm',
            ]
        ],
        'sliderrevolution' => [
            'class' => 'wadeshuler\sliderrevolution\SliderModule',
            'pluginLocation' => '@frontend/assets/revslider-demo/',    // <-- path to your rs-plugin directory
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/views/user',
                ],
            ],
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
        'user' => [
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],  
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['en-US', 'en', 'fr', 'de', 'es-*', 'pt'],
        ]
    ],
    'params' => $params,
];
