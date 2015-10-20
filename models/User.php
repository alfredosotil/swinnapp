<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {

    public $id;
    public $names;
    public $surnames;
    public $email;
    public $lastupdate;
    public $type_id;
    public $state_id;
    public $sex;
    public $profile_id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $active;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = Users::find()
                ->where("active=:active", [":active" => 1])
                ->andWhere("id=:id", ["id" => $id])
                ->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        $users = Users::find()
                ->where("active=:active", [":active" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $users = Users::find()
                ->where("active=:active", ["active" => 1])
                ->andWhere("username=:username", [":username" => $username])
                ->all();
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

}
