<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Core\Application;
use MVC\Core\Request;
use MVC\Core\Response;
use MVC\Form\LoginForm;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }

        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    
    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

}
