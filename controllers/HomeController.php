<?php 
namespace MVC\Controllers;


use MVC\Core\Application;
use MVC\Core\Controller;
use MVC\Middlewares\AuthMiddleware;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware([
            'profile',
        ]));
    }

    public function home() 
    {
        return $this->render('home', [
            'name' => !Application::$app->isGuest() ? Application::$app->user->getDisplayName()  : "to the forum website."
        ]);
    }

}
