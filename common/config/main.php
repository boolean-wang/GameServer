<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

    ],
    'as login' => [
        'class' => 'frontend\behaviors\LoginBehavior',
        'allowActions' => [
            'base/bind','site/*','public*','debug/*','gii/*', // 不需要权限检测
        ]
    ],
];
