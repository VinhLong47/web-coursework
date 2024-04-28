<?php

namespace MVC\models;


use MVC\Db\DbModel;

class CommentModel extends DbModel
{
    public int $id = 0;
    public string $comment = '';
    public int $user_id = 0;
    public int $thread_id = 0;
    public string $created; 

    public static function tableName(): string
    {
        return 'comments';
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
        return ['id', 'comment', 'created', 'user_id', 'thread_id'];
    }

    public function rules()
    {
        return [
            'comment' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'comment' => 'Comment'
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
            "comment",
            "user_id",
            "thread_id",
            "created",
        ]));
    }
}