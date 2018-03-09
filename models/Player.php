<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

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
class Player extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['campaign_id', 'sex'], 'default', 'value' => null],
            [['created_at'], 'default', 'value' => (new \DateTime())->format('Y-m-d H:i:s')],
            [['score', 'coins'], 'default', 'value' => 0],
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

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        /*$player = Yii::$app->session->get('user');
        if ($player === null) {
            $player = Player::find()->where(['id' => $id])->one();
        }
        return $player;*/
        return null;
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //TODO: найти способ поиска пользователя в редисе по uid
        return null;
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return null;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return null;
    }


}
