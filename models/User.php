<?php
namespace MVC\models;


use MVC\Core\UserModel;



class User extends UserModel
{
    public int $id = 0;
    public string $username = '';
    public string $email = '';
    public string $created = '';
    public string $pass = '';
    public string $passConfirm = '';
    public int $is_admin = 0;
   

    public static function tableName(): string
    {
        return 'users';
    }

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "username",
            "email",
            "created",
            "pass",
            "is_admin",
        ]));
    }

    public function attributes(): array
    {
        return ['username', 'email', 'pass', 'is_admin',];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'pass' => 'Password',
            'passConfirm' => 'Password Confirm'
        ];
    }

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'pass' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passConfirm' => [[self::RULE_MATCH, 'match' => 'pass']],
        ];
    }

    public function save()
    {
        $this->created = date('M-d-y H:i:s');

        $this->pass = password_hash($this->pass, PASSWORD_DEFAULT); 
        
        return parent::save();
    }

    public function getDisplayName(): string
    {
        return $this->username;
    }
}