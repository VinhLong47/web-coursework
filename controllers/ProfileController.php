<?php

namespace MVC\Controllers;

use MVC\Core\Application;
use MVC\Core\Controller;
use MVC\Core\Request;


class ProfileController extends Controller
{

    public function profile()
    {   
        $user = Application::$app->user;
        $sql = "SELECT COUNT(th.id) AS num_threads FROM users ur JOIN threads th ON th.user_id = ur.id WHERE ur.id = :id";
        $db = Application::$app->db;
        $statement = $db->prepare($sql);
        $statement->bindParam(":id", $user->id, \PDO::PARAM_INT);
        $statement->execute();
        $numThreads = $statement->fetchColumn();

        $sql = "SELECT COUNT(c.id) AS num_comments FROM users ur JOIN comments c ON c.user_id = ur.id WHERE ur.id = :id";
        $db = Application::$app->db;
        $statement = $db->prepare($sql);
        $statement->bindParam(":id", $user->id, \PDO::PARAM_INT);
        $statement->execute();
        $numComments = $statement->fetchColumn();

        return $this->render('profile', [
            'numThreads' => $numThreads,
            'numComments' => $numComments,
        ]);
    }

    public function profileWithId(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
