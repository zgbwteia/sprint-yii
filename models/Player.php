<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property int $campaign_id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $sex
 * @property string $birthday
 * @property int $score
 * @property int $coins
 * @property array $system
 * @property string $last_day
 * @property string $created_at
 *
 * @property Campaign $campaign
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'sex', 'score', 'coins'], 'default', 'value' => null],
            [['campaign_id', 'sex', 'score', 'coins'], 'integer'],
            [['login', 'name', 'email', 'phone', 'sex'], 'required'],
            [['birthday', 'last_day', 'created_at'], 'safe'],
            [['system'], 'string'],
            [['login', 'name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['campaign_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::class, 'targetAttribute' => ['campaign_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campaign_id' => 'Campaign ID',
            'login' => 'Login',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'score' => 'Score',
            'coins' => 'Coins',
            'system' => 'System',
            'last_day' => 'Last Day',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::class, ['id' => 'campaign_id']);
    }
}
