<?php

namespace MVC\Controllers;


use MVC\Core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return $this->render('about');
    }
}