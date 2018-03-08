<?php
/**
 * Created by PHPStorm.
 * User: daemon
 * Date: 08.03.18
 * Time: 13:42
 */

namespace app\controllers;


use yii\rest\ActiveController;

class MemberController extends ActiveController
{

    public $modelClass = 'app\models\Member';

}