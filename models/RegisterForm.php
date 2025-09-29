<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $email;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'match', 'pattern' => '/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[0-9a-zA-Z!@#$%^&*]/',
            'message' => "Пароль должен содержать как минимум одно заглавную букву, одну строчну и одну цифру. От 8 до 12 символом"],
            ['password', 'string', 'min' => 8, 'max' => 12, 'message' => 'Пароль должен содержать как минимум одно заглавную букву, одну строчну и одну цифру. От 8 до 12 символом']
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'password' => 'Пароль'
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    public function register(): bool | user
    {
        if ($this->validate()) {
            $user = new User();
            
            $user->load($this->attributes, '');
            $user->token = Yii::$app->security->generateRandomString();
            $user->password = yii::$app->security->generatePasswordHash($this->password);
            $user->role_id = Role::getRoleId('user');
            if (!$user->save()) {
                VarDumper::dump($user->errors, 10, true);
                die;
            }
            return $user ?? false;
        }
        return false;
    }



    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
