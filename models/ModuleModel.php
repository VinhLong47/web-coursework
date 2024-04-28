<?php

namespace MVC\models;

use MVC\Db\DbModel;

class ModuleModel extends DbModel
{
    public int $id = 0;
    public string $name = '';
    public string $created;

    public static function tableName(): string
    {
        return 'modules';
    }

    public function setCreatedAt(string $dateTimeString) {
        // Update the DateTime attribute with a new value
        $datetime = new \DateTime($dateTimeString);
        $this->created = $datetime->format('Y-m-d\TH:i:s');
    }

    public function getCreatedAt(): string {
        return $this->created;
    }

    public function attributes(): array
    {
        return ['name', 'created'];
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Module Name'
        ];
    }

    
    public function save()
    {
        $this->setCreatedAt("now");
        return parent::save();
    }

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "name",
            "created",
        ]));
    }
}