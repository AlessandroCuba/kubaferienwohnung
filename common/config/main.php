<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'favorites' => [
            'class' => 'thyseus\favorites\Module',
        ],
        'attachments' => [
            'class' => nemmo\attachments\Module::className(),
            'tempPath' => '@common/images/casas',
            'storePath' => '@common/images/casas',
            'rules' => [ // Rules according to the FileValidator
                'maxFiles' => 10, // Allow to upload maximum 3 files, default to 3
            	'mimeTypes' => 'image/*', 
            	'maxSize' => 1024 * 1024 // 1 MB
            ],
            'tableName' => '{{%images}}', // Optional, default to 'attach_file'
            'controllerMap' => [
                'migrate' => [ 
                    'class' => 'yii\console\controllers\MigrateController', 
                    'migrationNamespaces' => ['nemmo\attachments\migrations'], 
                ],
            ],
	],
        'blog' => [
            'class' => 'funson86\blog\Module',
            // This option automatically translit entered titles 
            // from russian symbols to english on fly. Default false.
            'autoTranslit' => true, 
            // Some options for CKEditor. Default custom options.
            'editorOptions' => [
                'language' => 'es',
                'menubar' => false,
                'height' => 500,
                'image_dimensions' => false,
                'plugins' => [
                    'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            ],
            // callback function for create post view url. Have $model argument.
            'viewPostUrlCallback' => function($model) {
                                        return '/' . $model->alias;
                                    },
        ],
    ],
    'timeZone' => 'Europe/Berlin',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@funson86/blog/views/frontend' => '@frontend/views/blog',
                    //'@funson86/blog/views/frontend/layouts' => '@frontend/views/layouts'
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['Guest']
        ],
        'urlManager' => [
            'class' => yii\web\UrlManager::className(),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'register' => 'user/registration/register',
                'resend' => 'user/registration/resend',
                'confirm/<id:\d+>/<token:\w+>' => 'user/registration/confirm',
                'login' => 'user/auth/login',
                'logout' => 'user/auth/logout',
                'recovery' => 'user/recovery/request',
                'reset/<id:\d+>/<token:\w+>' => 'user/recovery/reset',
            ],
                //'<lang:\w{2}>/<controller>/<action>/' => '<controller>/<action>',
                //'<lang:\w{2}>/<controller:\w+>/<id:\d+>' => '<controller>/view',
                //'<lang:\w{2}>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ],
        /*========= ANADIDO NUEVO TRANSLATATION ==========*/
        'i18n' => [
            'class'      => uran1980\yii\modules\i18n\components\I18N::className(),
            'languages'  => ['en', 'de', 'fr', 'es', ],
            'format'     => 'db',
            'sourcePath' => [
                __DIR__ . '/../../frontend',
                __DIR__ . '/../../backend',
                __DIR__ . '/../../common',
            ],
            'messagePath' => __DIR__  . '/../../messages',
            'translations' => [
                '*' => [
                    'class'           => yii\i18n\DbMessageSource::className(),
                    'enableCaching'   => true,
                    'cachingDuration' => 60 * 60 * 2, // cache on 2 hours
                ],
            ],
        ],
        /*===============================================*/
        'formatter' => [ //for the showing of date datetime
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],
    ],
];
