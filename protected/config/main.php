<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'karmio beta',
    //default controller should be product
    'defaultController' => 'site',
    //custom theme
    'theme' => 'pledgeOn',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.facebook.*',
        'application.extensions.FacebookExtension4Yii.*',
        'application.extensions.FacebookExtension4Yii.lib.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'sudogii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        /*'request'=>array(
            'class' => 'CmsCHttpRequest',
        ),*/
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts',
        ),
        // uncomment the following to enable URLs in path-format
        
//          'urlManager'=>array(
//          'urlFormat'=>'path',
//           'showScriptName'=>false,
//          'rules'=>array(
//          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
//          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//          ),
//          ),
         
        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=shassan_v2',
            'emulatePrepare' => true,
            'username' => 'shassan_v2user',
            'password' => '123Karmiopma',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'team@karm.io',
        'FB_APP_ID' => '508945735796470',
        'FB_APP_SECRET' => '4ba21f0760d6f6c67e336a0b2ae8e068',
        "AUTHORIZENET_API_LOGIN_ID" => "9M9qM7w62b",
        "AUTHORIZENET_TRANSACTION_KEY" =>"9k748HYdpyH6B487",
        "AUTHORIZENET_SANDBOX" => false,
        "TEST_REQUEST" => false,
        "NFG_PARTNER_ID" => "K4RM1O",
        "NFG_PARTNER_PW" => "Kx1Lm3r5",
        "NFG_PARTNER_SOURCE" => "KMIO",
        "NFG_CAMPAIGN" => "DEAL",
        "NFG_URL" => "https://api.networkforgood.org/PartnerDonationService/DonationServices.asmx?wsdl",
        "CHARITY_MAGIC" => "100365167458",
        'MCAPI' => '46fadbc560ef675746c6711a14078243-us5',
        "MANDRILL_KEY" => 'qPaly6CoNFtpUcIe5AXyFg',
    ),
);
