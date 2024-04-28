<?php
namespace MVC\Form;


use MVC\Core\Model;

class Field extends BaseField
{
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_FILE = 'file';
    const TYPE_IMAGE = 'image';
    const ACCEPT_ONLY_IMAGE_FILE = 'accept="image/*"';

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function renderInput()
    {
        $input = '<input type="%s" class="form-control%s" name="%s" value="%s">';
        if ($this->type == self::TYPE_IMAGE) {
            $input = '<input type="%s"'.self::ACCEPT_ONLY_IMAGE_FILE.'class="form-control%s" name="%s" value="%s">';
            $this->type = self::TYPE_FILE;
        }
        return sprintf($input,
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField()
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function imageField()
    {
        $this->type = self::TYPE_IMAGE;
        return $this;
    }
}