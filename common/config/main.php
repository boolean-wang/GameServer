<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],

    ],
    'as login' => [
        'class' => 'frontend\behaviors\LoginBehavior',
        'allowActions' => [
            'base/bind','site/*','public*','debug/*','gii/*', // 不需要权限检测
        ]
    ],
];
