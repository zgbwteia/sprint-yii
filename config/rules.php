<?php
/**
 * Created by PHPStorm.
 * User: daemon
 * Date: 09.03.18
 * Time: 13:21
 */

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'campaign',
        'prefix' => '/api'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'campaigns/status',
        'prefix' => '/api'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'campaigns/type',
        'prefix' => '/api'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'member',
        'prefix' => '/api'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'members/type',
        'prefix' => '/api'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'player',
        'prefix' => '/api'
    ],
    'GET /api/game/init' => 'game/init',
    'GET /api/game/info' => 'game/info',
    'POST /api/game/login' => 'game/login',
];