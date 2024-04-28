<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Core\Request;
use MVC\models\ContactModel;


class ContactController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new ContactModel();
    }
    public function create(Request $request)
    {
        $contact = $this->model;
        
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
    
            if ($contact->validate() && $contact->save()) {
                return $this->render('thanks', [
                ], "Thank You");
            }            
        }

        return $this->render('contact', [
            'model' => $this->model
        ], "Contact");
    }
}
