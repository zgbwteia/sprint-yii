<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_type".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Member[] $members
 */
class MemberType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'default', 'value' => (new \DateTime())->format('Y-m-d H:i:s')],
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
    public function getMembers()
    {
        return $this->hasMany(Member::class, ['member_type_id' => 'id']);
    }
}
