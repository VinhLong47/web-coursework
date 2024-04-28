<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Core\Application;
use MVC\Core\Request;
use MVC\Common\Common_function;
use MVC\models\ThreadModel;
use MVC\models\ModuleModel;
use MVC\models\CommentModel;
use MVC\Middlewares\AuthMiddleware;


class ThreadController extends Controller
{
    public $me;
    public function __construct()
    {;
        $this->registerMiddleware(new AuthMiddleware([
            'thread',
            'comment',
            'editThread',
            'deleteThread',
        ]));
        $this->me = Application::$app->user;
    }

    public function thread(Request $request)
    {
        $threadModel = new ThreadModel();
        $modules = ModuleModel::findAll([], 1000, 0);
        if ($request->getMethod() === 'post') {
            $threadModel->loadData($request->getBody());
            if ($threadModel->validate()) {
                $upload_img_path = Common_function::upload_img_file();
                if ($upload_img_path) {
                    $threadModel->img = $upload_img_path;
                }
                $threadModel->user_id = $this->me->id;
                $threadModel->save();
                Application::$app->session->setFlash('success', 'Thread created successfully!');
                Application::$app->response->redirect('/threads');
            }
        }
        return $this->render('createThread', [
            "model" => $threadModel,
            "modules" => $modules,
        ]);
    }

    public function threads(Request $request)
    {
        $data = $request->getBody();
        $filters = [];
        if (isset($data["module_id"])) $filters += ["module_id" => $data["module_id"]];
        $page = isset($data["page"]) ? $data["page"] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $threadModel = ThreadModel::findAll($filters, $limit, $offset, "created_at DESC");
        $totalThreads = ThreadModel::countAll($filters);
        $totalPage = ceil($totalThreads / $limit);
        
        return $this->render('threads', [
            "threads" => $threadModel,
            "totalPage" => $totalPage,
            "currentPage" => $page,
        ]);
    }

    public function comment(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        if(!isset($id)) throw new \MVC\Exception\BadRequestException("You missed id route param");
        if(!ThreadModel::findOne(["id" => $id])) throw new \MVC\Exception\BadRequestException("Not found thread");
        $commentModel = new CommentModel();
        if ($request->getMethod() === 'post') {
            $commentModel->loadData($request->getBody());
            $commentModel->user_id = $this->me->id;
            $commentModel->thread_id = $id;
            if ($commentModel->validate()) {
                $commentModel->save();
                Application::$app->session->setFlash('success', 'You commented successfully!');
                Application::$app->response->redirect("/threads/".$id);
            }
        }
    }

    public function detail(Request $request)
    {
        $data = $request->getBody();
        $id = (int)$request->getRouteParam($param="id");
        $page = isset($data["page"]) ? $data["page"] : 1;
        $threadModel = ThreadModel::findOne(["id" => $id]);

        $limit = 2;
        $offset = ($page - 1) * $limit;
        $comments = CommentModel::findAll(["thread_id" => $threadModel->id], $limit, $offset, );
        $totalComments = CommentModel::countAll(["thread_id" => $threadModel->id]);
        $totalPage = ceil($totalComments / $limit);
        return $this->render('detailThread', [
            "thread" => $threadModel,
            "comments" => $comments,
            "totalPage" => $totalPage,
            "currentPage" => $page,
        ]);
    }

    public function editThread(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $thread = ThreadModel::findOne(["id" => $id]);

        if ($thread->user_id != $this->me->id) throw new \MVC\Exception\ForbiddenException("You are not author of this thread!");
        
        if (!$thread) throw new \MVC\Exception\BadRequestException("Not Found Thread!");
        
        if ($request->isPost()) {
            $data = $request->getBody();
            $upload_img_path = Common_function::upload_img_file();

            $thread->loadData($data);
            if ($upload_img_path) {
                $thread->img = $upload_img_path;
            }
            $updateData = $thread->getUpdateData();
            if ($thread->validate()) {
                ThreadModel::update($updateData);
                Application::$app->session->setFlash('success', 'The thread ID='.$thread->id.' was edited successfully!');
                Application::$app->response->redirect("/threads/$thread->id");
            } else {
                throw new \MVC\Exception\BadRequestException("Request data is invalid");
            }
        } else {
            throw new \MVC\Exception\BadRequestException("Method is not allowed!");
        }
    }

    public function deleteThread(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $thread = ThreadModel::findOne(["id" => $id]);

        if ($thread->user_id != $this->me->id) throw new \MVC\Exception\ForbiddenException("You are not author of this thread!");

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$thread) throw new \MVC\Exception\BadRequestException("Not Found This User!");

        $thread->delete();
        Application::$app->session->setFlash('success', 'The thread ID='.$thread->id.' was deleted successfully!');
        Application::$app->response->redirect('/threads');
    }
}
