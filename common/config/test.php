<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        /*
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],*/
        
        'authManager'=>[
        	'class'=> 'yii\rbac\DbManager',
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                //'site/*',
                //'admin/*',
                //'some-controller/some-action',
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],  
    ],
    'modules' => [
    	'admin'=>[
    		'class' => 'mdm\admin\Module',
    	]
    ],
];
