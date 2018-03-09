<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign_type".
 *
 * @property int $id
 * @property string $name
 * @property int $campaign_status_id
 * @property string $created_at
 *
 * @property Campaign[] $campaigns
 * @property CampaignStatus $campaignStatus
 */
class CampaignType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'campaign_status_id'], 'required'],
            [['created_at'], 'default', 'value' => (new \DateTime())->format('Y-m-d H:i:s')],
            [['campaign_status_id'], 'default', 'value' => null],
            [['campaign_status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['campaign_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CampaignStatus::class, 'targetAttribute' => ['campaign_status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'campaign_status_id' => 'Campaign Status ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::class, ['campaign_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignStatus()
    {
        return $this->hasOne(CampaignStatus::class, ['id' => 'campaign_status_id']);
    }
}
