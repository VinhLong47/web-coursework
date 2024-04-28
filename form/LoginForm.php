<?php
namespace MVC\Form;


use MVC\Core\Application;
use MVC\Core\Model;
use MVC\models\User;


class LoginForm extends Model
{
    public string $email = '';
    public string $passEnter = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'passEnter' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address',
            'passEnter' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->passEnter, $user->pass)) {
            $this->addError('passEnter', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}