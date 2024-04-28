<?php
namespace MVC\Exception;


class InternalServerErrorException extends \Exception
{
    protected $message = 'Internal Server Error';
    protected $code = 500;
}