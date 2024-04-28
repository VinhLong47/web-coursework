<?php

namespace MVC\models;

use MVC\Db\DbModel;


class ThreadModel extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public string $description = '';
    public string $img = '';
    public int $user_id = 0;
    public int $module_id = 1;
    public string $created_at;

    public function setCreatedAt(string $dateTimeString) {
        // Update the DateTime attribute with a new value
        $datetime = new \DateTime($dateTimeString);
        $this->created_at = $datetime->format('Y-m-d\TH:i:s');
    }

    public function getCreatedAt(): string {
        return $this->created_at;   
    }

    public static function tableName(): string
    {
        return 'threads';
    }

    public function attributes(): array
    {
        return ['name', 'description', 'img', 'module_id', 'user_id'];
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Thread Name',
            'description' => 'Description',
            'img' => 'Upload Image',
        ];
    }

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "name",
            "description",
            "img",
            "user_id",
            "module_id",
            "created_at",
        ]));
    }
    
    public function save()
    {
        $this->setCreatedAt("now");
        return parent::save();
    }
}