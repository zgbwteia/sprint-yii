<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign_status".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property CampaignType[] $campaignTypes
 */
class CampaignStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignTypes()
    {
        return $this->hasMany(CampaignType::class, ['campaign_status_id' => 'id']);
    }
}
