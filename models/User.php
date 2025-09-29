<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $role_id
 * @property string $token
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'role_id', 'token'], 'required'],
            [['role_id'], 'integer'],
            [['email', 'password', 'token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'token' => 'Token',
        ];
    }

    

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($attribute): false | user
    {
        return self::findOne(['email' => $attribute]) ?? false;
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function getEmail($id): string | null
    {
        return static::findOne($id)?->email;
    }

    public function getIsAdmin()
    {
        return $this->role_id === 2;
    }
}
