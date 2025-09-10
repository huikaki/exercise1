<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'Exercise1',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\components\Aliases',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@extension' => '@app/extension',
        '@webroot' => '/path/to/your/app/web',
    ],
    'modules' => [
        'CMSAdmin' => [
            'class' => 'app\modules\CMSAdmin\Module',
            // 'components' => [
            //     'menu' => 'app\modules\CMSAdmin\components\Menu',
            // ],
        ],

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0bXHCMrVM3F9qnqWyaVUR954iDivmWiH',
            'baseUrl' => '/exercise1',

            'csrfCookie' => [
                'httpOnly' => true,
                'secure' => true,
                'sameSite' => 'lax',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<module:(CMSAdmin|ckeditorRoxyFileman|gii)>/<controller:[\w-]+>/<action:[\w-]+>/<id:[a-zA-Z0-9-][a-zA-Z0-9,-]*>' => '<module>/<controller>/<action>',
                '<module:(CMSAdmin|ckeditorRoxyFileman|gii)>/<controller:[\w-]+>/<action:[\w-]+>' => '<module>/<controller>/<action>',
                '<module:(CMSAdmin|ckeditorRoxyFileman|gii)>/<controller:[\w-]+>' => '<module>/<controller>',
                '<module:(CMSAdmin|ckeditorRoxyFileman|gii)>' => '<module>',
                // Updated rule to allow slashes and other special characters in maid_no
                'member/<maid_no:[^/]+>' => 'member/view',
                'member' => 'member/index',
                'member/generate-pdf/<maid_no:\w+>' => 'member/generate-pdf',
                // Other existing rules

                '<controller:[\w-]+>/<action:[\w-]+>/<id:[a-zA-Z0-9-][a-zA-Z0-9,-]*>' => '<controller>/<action>',
                'site/index' => 'site/index',
                'site/about' => 'site/about',
                'site/language' => 'site/language',
                'site/<id:[a-zA-Z0-9-][a-zA-Z0-9,-]*>' => 'site/page',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
