<?php


namespace MVC\Middlewares;


use MVC\Core\Application;


class CheckRoleMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        // User must be admin
        if (!Application::$app->user || Application::$app->user->is_admin != 1) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new \MVC\Exception\ForbiddenException();
            }
        }
    }
}