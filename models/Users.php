<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $names
 * @property string $surnames
 * @property string $email
 * @property string $username
 * @property string $password
 * @property integer $active
 * @property string $lastupdate
 * @property integer $type_id
 * @property integer $state_id
 * @property string $sex
 * @property integer $profile_id
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Profile $profile
 * @property State $state
 * @property Type $type
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['names', 'surnames', 'email', 'username', 'password', 'active', 'type_id', 'state_id', 'sex', 'profile_id'], 'required'],
            [['active', 'type_id', 'state_id', 'profile_id'], 'integer'],
            [['lastupdate'], 'safe'],
            [['names'], 'string', 'max' => 100],
            [['surnames', 'email', 'username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 45],
            [['sex'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'names' => 'Names',
            'surnames' => 'Surnames',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'active' => 'Active',
            'lastupdate' => 'Lastupdate',
            'type_id' => 'Type ID',
            'state_id' => 'State ID',
            'sex' => 'Sex',
            'profile_id' => 'Profile ID',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
