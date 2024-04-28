<?php
namespace MVC\Form;


use MVC\Core\Application;
use MVC\models\User;


class EditUserModelForm extends User
{
    public int $id = 0;
    public string $username = '';
    public string $email = '';
    public int $is_admin = 0;

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "email",
            "username",
            "is_admin",
        ]));
    }

    public function attributes(): array
    {
        return ['username', 'email', 'pass', 'is_admin',];
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'is_admin' => 'Admin',
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
            ]]
        ];
    }
}