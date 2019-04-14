<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'KELASKOSONG.MN',
	'theme'=>'start',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/**/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			//tambahan untuk yiibooster!!!
			'generatorPaths'=>array(
			'bootstrap.gii', // boostrap generator
			),
			//END OF TAMBAHAN YIIBOOSTER
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		/*		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
    'bootstrap'=>array(
       'class'=>'ext.bootstrap.components.Booster',
       'responsiveCss'=>true,
    ),		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/**/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*		*/
		'db'=> require(__DIR__ . '/db.php'),
		/*		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
			
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, info, error, warning',
				),
			
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace, info, error, warning',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@admin.com',
	),
);

$config = array(
    'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                //admin rules
                'administrator/<action:(dashboard|forgot|logout)>' => 'administrator/<action>',
                'administrator/<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/administrator/<action>',
                'administrator/<module:\w+>/<action:\w+>' => '<module>/administrator/<action>',
                'administrator/<module:\w+>' => '<module>/administrator',
                //admin rules
                'signup/<action:(dashboard|forgot|logout)>' => 'signup/<action>',
                'signup/<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/signup/<action>',
                'signup/<module:\w+>/<action:\w+>' => '<module>/signup/<action>',
                'signup/<module:\w+>' => '<module>/signup',				
            ),
        ),
)
);
return $config;
