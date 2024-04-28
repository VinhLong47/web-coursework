<?php
namespace MVC\Form;


use MVC\Core\Application;
use MVC\Db\DbModel;


class ChangePasswordForm extends DbModel
{
    public int $id = 0;
    public string $newPassword = '';
    public string $newPasswordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['pass'];
    }

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "password",
        ]));
    }

    public function labels(): array
    {
        return [
            'newPassword' => 'New Password',
            'newPasswordConfirm' => 'Confirm New Password',
        ];
    }

    public function rules()
    {
        return [
            'newPassword' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'newPasswordConfirm' => [[self::RULE_MATCH, 'match' => 'newPassword']],
        ];
    }
}