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
use yii\rest\Controller;

class GameController extends Controller {

    public function actionInit($campaign_id) {
        $campaign = Campaign::find()->where(['id' => $campaign_id])->all()[0];
        $campaign_status = CampaignStatus::find()->leftJoin(CampaignType::tableName(), CampaignStatus::tableName() . '.id = ' . CampaignType::tableName() . '.campaign_status_id')->where([CampaignType::tableName() . '.id' => $campaign->campaign_type_id])->all()[0];

        return [
            'status' => $campaign_status->name,
            'custom_setting' => $campaign->custom_setting,
            'time_server' => (new \DateTime)->getTimestamp()
        ];
    }

}