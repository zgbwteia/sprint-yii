<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property array $system_field
 * @property int $member_type_id
 * @property string $created_at
 *
 * @property Campaign[] $campaigns
 * @property MemberType $memberType
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'password'], 'required'],
            [['system_field'], 'string'],
            [['member_type_id'], 'default', 'value' => null],
            [['member_type_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 20],
            [['member_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MemberType::class, 'targetAttribute' => ['member_type_id' => 'id']],
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
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'system_field' => 'System Field',
            'member_type_id' => 'Member Type ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::class, ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberType()
    {
        return $this->hasOne(MemberType::class, ['id' => 'member_type_id']);
    }
}
