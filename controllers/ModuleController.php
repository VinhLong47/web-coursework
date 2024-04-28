<?php

namespace MVC\Controllers;

use MVC\Models\ModuleModel;


use MVC\Core\Controller;

class ModuleController extends Controller
{
    public function module()
    {
        $modules = ModuleModel::findAll([], 1000, 0);
        $totalModules = ModuleModel::countAll([]);
        $totalPage = ceil($totalModules / 5);
        return $this->render('module', [
            "modules" => $modules,
            "totalModules" => $totalModules,
            "totalPage" => $totalPage,
        ]);
    }
}