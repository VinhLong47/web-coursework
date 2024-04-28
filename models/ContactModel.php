<?php

namespace MVC\Models;


use MVC\Db\DbModel;

/*
$contact_table_sql = "CREATE TABLE IF NOT EXISTS `$CONSTANTS->CONTACT_TABLE` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emailAddress VARCHAR (255) NOT NULL,
    subject VARCHAR( 255 ) NOT NULL,
    message TEXT NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL
    );
";
*/
class ContactModel extends DbModel
{
    public int $id = 0;
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public string $created_at;

    public function setCreatedAt(string $dateTimeString) {
        // Update the DateTime attribute with a new value
        $datetime = new \DateTime($dateTimeString);
        $this->created_at = $datetime->format('Y-m-d\TH:i:s');
    }

    public function attributes(): array
    {
        return ['email', 'subject', 'message', 'created_at'];
    }

    public function getCreatedAt(): string {
        return $this->created_at;   
    }

    public static function tableName(): string
    {
        return "contact";
    }

    public static function dbFields(): string
    {
        return implode(",", array_map(fn($attr) => "$attr", [
            "id",
            "subject",
            "message",
            "email",
            "created_at",
        ]));
    }

    public function labels(): array
    {
        return [
            'subject' => 'Subject',
            'message' => 'Message',
            'email' => 'Your Email',
        ];
    }

    public function rules()
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];
    }

    public function save()
    {
        try {
            $this->setCreatedAt("now");
            return parent::save();
        } catch (\Exception $e) {
            throw new \MVC\Exception\InternalServerErrorException($e->getMessage());
        }
    }
}