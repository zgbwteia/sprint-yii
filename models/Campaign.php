<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property int $id
 * @property int $member_id
 * @property int $campaign_type_id
 * @property string $name
 * @property int $login_type
 * @property string $custom_setting
 * @property string $message_end
 * @property string $created_at
 *
 * @property CampaignType $campaignType
 * @property Member $member
 * @property Player[] $players
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'campaign_type_id', 'login_type'], 'default', 'value' => null],
            [['created_at'], 'default', 'value' => (new \DateTime())->format('Y-m-d H:i:s')],
            [['member_id', 'campaign_type_id', 'login_type'], 'integer'],
            [['member_id', 'campaign_type_id', 'name', 'login_type'], 'required'],
            [['custom_setting', 'message_end'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['campaign_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CampaignType::class, 'targetAttribute' => ['campaign_type_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::class, 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'campaign_type_id' => 'Campaign Type ID',
            'name' => 'Name',
            'login_type' => 'Login Type',
            'custom_setting' => 'Custom Setting',
            'message_end' => 'Message End',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignType()
    {
        return $this->hasOne(CampaignType::class, ['id' => 'campaign_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::class, ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::class, ['campaign_id' => 'id']);
    }
}
