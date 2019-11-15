<?php
return [
    'components' => [
        'db' => [
            'class' => yii\db\Connection::className(),
            'dsn' => 'mysql:host=39.96.222.5;port=3306;dbname=pro',
            'username' => 'guoguo',
            'password' => 'guoguo123',
            'charset' => 'utf8',
            'tablePrefix' => 'pro_',
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => yii\debug\Module::className(),
            'allowedIPs' => ['127.0.0.1', '::1']
        ]
    ]
];
