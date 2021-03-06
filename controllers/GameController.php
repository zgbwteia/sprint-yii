<?php
/**
 * Created by PHPStorm.
 * User: daemon
 * Date: 09.03.18
 * Time: 13:22
 *
 * Author: Dmitry Malakhov (abr_mail@mail.ru)
 * Prohibited for commercial use without the prior written consent of author
 *
 * Автор: Дмитрий Малахов (abr_mail@mail.ru)
 * Запрещено использование в коммерческих целях без письменного разрешения автора
 */

namespace app\controllers;

use app\models\Campaign;
use app\models\CampaignStatus;
use app\models\CampaignType;
use app\models\Player;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class GameController extends Controller {

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['init', 'login'],
            'tokenParam' => 'uid'
        ];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'actions' => ['init', 'login'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['info'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ]
        ];
        return $behaviors;
    }

    /**
     * @param $campaign_id
     * @return array
     */
    public function actionInit($campaign_id) {
        $campaign = Campaign::find()->where(['id' => $campaign_id])->all()[0];
        $campaign_status = CampaignStatus::find()->leftJoin(CampaignType::tableName(), CampaignStatus::tableName() . '.id = ' . CampaignType::tableName() . '.campaign_status_id')->where([CampaignType::tableName() . '.id' => $campaign->campaign_type_id])->all()[0];

        return [
            'status' => $campaign_status->name,
            'custom_setting' => $campaign->custom_setting,
            'time_server' => (new \DateTime)->getTimestamp()
        ];
    }

    public function actionInfo() {
        $player = Player::find()->where(['id' => Yii::$app->user->getId()])->one();
        $params = [
            'id' => null,
            'name' => null,
            'email' => null,
            'phone' => null,
            'sex' => null,
            'birthday' => null,
            'system' => null,
            'coins' => null,
            'score' => null,
            'created_at' => null,
            'last_day' => null
        ];

        foreach ($params as $name => $value) {
            $params[$name] = $player->$name;
        }

        return [
            'data' => $params
        ];
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionLogin() {
        $params = [
            'campaign_id' => null,
            'login' => null,
            'name' => null,
            'email' => null,
            'phone' => null,
            'sex' => null,
            'birthday' => null
        ];
        foreach ($params as $name => $value) {
            $params[$name] = Yii::$app->request->post($name);
        }
        $player = Player::find()->where(['email' => $params['email']])->orWhere(['phone' => $params['name']])->one();
        if ($player === null) {
            $player = new Player($params);
            if (!$player->save()) {
                throw new BadRequestHttpException(Yii::t('yii', $player->getErrorSummary(true)[0]));
            }
        }

        return [
            'data' => [
                'system' => $player->system,
                'coins' => $player->coins,
                'score' => $player->score,
                'reg_date' => $player->created_at,
                'last_day' => $player->last_day,
            ],
            'uid' => $player->generateUid()
        ];
    }

}