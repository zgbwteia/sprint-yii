<?php
/**
 * Created by PHPStorm.
 * User: daemon
 * Date: 08.03.18
 * Time: 13:42
 *
 * Author: Dmitry Malakhov (abr_mail@mail.ru)
 * Prohibited for commercial use without the prior written consent of author
 *
 * Автор: Дмитрий Малахов (abr_mail@mail.ru)
 * Запрещено использование в коммерческих целях без письменного разрешения автора
 */

namespace app\controllers\members;


use yii\rest\ActiveController;

class TypeController extends ActiveController
{

    public $modelClass = 'app\models\MemberType';

}