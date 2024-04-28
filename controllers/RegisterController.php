<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Core\Application;
use MVC\Core\Request;
use MVC\models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'resgiter complete!');
                Application::$app->response->redirect('/login');
                return;
            }
        }
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
