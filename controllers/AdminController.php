<?php
namespace MVC\Controllers;

use MVC\Core\Application;
use MVC\Core\Controller;
use MVC\Core\Request;
use MVC\Middlewares\AuthMiddleware;
use MVC\Middlewares\CheckRoleMiddleware;
use MVC\Models\ModuleModel;
use MVC\Models\User;
use MVC\Exception\BadRequestException;
use MVC\Form\ChangePasswordForm;
use MVC\Form\EditUserModelForm;
use MVC\models\ThreadModel;
use MVC\models\ContactModel;
use MVC\models\CommentModel;


class AdminController extends Controller
{
    public function __construct()
    {;
        $this->registerMiddleware(new AuthMiddleware([
            'index',
            'addModule',
            'editModule',
            'deleteModule',
            'addUser',
            'editUser',
            'deleteUser',
            'deleteThread',
            'deleteContact',
            'deleteComment',
        ]));
        $this->registerMiddleware(new CheckRoleMiddleware([
            'index',
            'addModule',
            'editModule',
            'deleteModule',
            'addUser',
            'editUser',
            'deleteUser',
            'deleteThread',
            'deleteContact',
            'deleteComment',
        ]));
    }

    public function index(Request $request)
    {
        $data = $request->getBody();
        $page = isset($data["page"]) ? $data["page"] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $tab = isset($_GET["tab"]) ? $_GET["tab"] : "modules";
        
        if (!in_array($tab, ['threads', 'modules', 'users', 'modules', 'contacts', 'comments'])) throw new BadRequestException("Invalid tab query param!");

        $modules = ModuleModel::findAll([], $limit, $offset);
        $totalModules = ModuleModel::countAll();
        $totalPageModules = ceil($totalModules / $limit);

        $users = User::findAll([], $limit, $offset);
        $totalUsers = User::countAll([]);
        $totalPageUsers = ceil($totalUsers / $limit);

        $threads = ThreadModel::findAll([], $limit, $offset, "created_at DESC");
        $totalThreads = ThreadModel::countAll([]);
        $totalPageThreads = ceil($totalThreads / $limit);

        $contacts = ContactModel::findAll([], $limit, $offset, "created_at DESC");
        $totalContacts = ContactModel::countAll([]);
        $totalPageContacts = ceil($totalContacts / $limit);

        $comments = CommentModel::findAll([], $limit, $offset, "created_at DESC");
        $totalComments = CommentModel::countAll([]);
        $totalPageComments = ceil($totalComments / $limit);

        return $this->render($view='admin', $params=[
            "modules" => $modules,
            "totalModules" => $totalModules,
            "totalPageModules" => $totalPageModules,

            "users" => $users,
            "totalUsers" => $totalUsers,
            "totalPageUsers" => $totalPageUsers,

            "contacts" => $contacts,
            "totalContacts" => $totalContacts,
            "totalPageContacts" => $totalPageContacts,

            "threads" => $threads,
            "totalThreads" => $totalThreads,
            "totalPageThreads" => $totalPageThreads,

            "comments" => $comments,
            "totalComments" => $totalComments,
            "totalPageComments" => $totalPageComments,

            "currentPage" => $page,
            "tab" => $tab,
        ], $title="Admin");
    }

    public function addModule(Request $request)
    {
        $module = new ModuleModel();
        
        if ($request->isPost()) {
            $module->loadData($request->getBody());
            if ($module->validate() && $module->save()) {
                Application::$app->session->setFlash('success', 'A new module was added successfully!');
                Application::$app->response->redirect('/admin?tab=modules');
            }
        }

        return $this->render('adminAddModule', [
            'model' => $module
        ], "Add Module");
    }

    public function editModule(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $module = ModuleModel::findOne(["id" => $id]);
        
        if (!$module) throw new \MVC\Exception\BadRequestException("Not Found Module!");
        
        if ($request->isPost()) {
            $data = $request->getBody();
            $module->loadData($data);
            $updateData = $module->getUpdateData();
            if ($module->validate()) {
                ModuleModel::update($updateData);
                Application::$app->session->setFlash('success', 'The '.$module->name.' module was updated successfully!');
                Application::$app->response->redirect('/admin?tab=modules');
            }
        }

        return $this->render('adminEditModule', [
            'model' => $module
        ], "Edit Module");
    }

    public function deleteModule(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $module = ModuleModel::findOne(["id" => $id]);

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$module) throw new \MVC\Exception\BadRequestException("Not Found Your Module!");

        $module->delete();
        Application::$app->session->setFlash('success', 'The module ID='.$module->id.' was deleted successfully!');
        Application::$app->response->redirect('/admin?tab=modules');
    }

    public function addUser(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $data = $request->getBody();
            $data["is_admin"] = isset($data["is_admin"]) ? 1 : 0;
            $user->loadData($data);
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'The new user was added successfully!');
                Application::$app->response->redirect('/admin?tab=users');
            }
        }

        return $this->render('adminAddUser', [
            'model' => $user,
        ], "Add User");
    }

    public function editUser(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $user = EditUserModelForm::findOne(["id" => $id]);
        
        if (!$user) throw new \MVC\Exception\BadRequestException("Not Found Module!");
        
        if ($request->isPost()) {
            $data = $request->getBody();
            $data["is_admin"] = !empty($data["is_admin"]) ? 1 : 0;
            $user->loadData($data);
            $updateData = $user->getUpdateData();
            if ($user->validate()) {
                EditUserModelForm::update($updateData);
                Application::$app->session->setFlash('success', 'The user ID='.$user->id.' was added successfully!');
                Application::$app->response->redirect('/admin?tab=users');
            }
        }

        return $this->render('adminEditUser', [
            'model' => $user
        ], "Edit USer");
    }

    public function deleteUser(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $user = User::findOne(["id" => $id]);

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$user) throw new \MVC\Exception\BadRequestException("Not Found This User!");

        $user->delete();
        Application::$app->session->setFlash('success', 'The user ID='.$user->id.' was deleted successfully!');
        Application::$app->response->redirect('/admin?tab=users');
    }

    public function changePassword(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $user = ChangePasswordForm::findOne(["id" => $id]);
        
        if (!$user) throw new \MVC\Exception\BadRequestException("Not Found User!");
        
        if ($request->isPost()) {
            $data = $request->getBody();
            $user->loadData($data);
            if ($user->validate()) {
                $user->password = password_hash($user->newPassword, PASSWORD_DEFAULT);
                $updateData = $user->getUpdateData();
                ChangePasswordForm::update($updateData);
                Application::$app->session->setFlash('success', 'Password of user ID='.$user->id.' was changed successfully!');
                Application::$app->response->redirect('/admin?tab=users');
            }
        }

        return $this->render('adminChangePassowrd', [
            'model' => $user
        ], "Change Password");
    }

    public function deleteThread(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $thread = ThreadModel::findOne(["id" => $id]);

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$thread) throw new \MVC\Exception\BadRequestException("Not Found This User!");

        $thread->delete();
        Application::$app->session->setFlash('success', 'The thread ID='.$thread->id.' was deleted successfully!');
        Application::$app->response->redirect('/admin?tab=threads');
    }

    public function deleteContact(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $contact = ContactModel::findOne(["id" => $id]);

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$contact) throw new \MVC\Exception\BadRequestException("Not Found This Contact!");

        $contact->delete();
        Application::$app->session->setFlash('success', 'The contact ID='.$contact->id.' was deleted successfully!');
        Application::$app->response->redirect('/admin?tab=contacts');
    }

    public function deleteComment(Request $request)
    {
        $id = (int)$request->getRouteParam($param="id");
        $comment = CommentModel::findOne(["id" => $id]);

        if (!$request->isGet()) throw new \MVC\Exception\BadRequestException("Method is not allowed!");

        if (!$comment) throw new \MVC\Exception\BadRequestException("Not Found This Comment!");

        $comment->delete();
        Application::$app->session->setFlash('success', 'The comment ID='.$comment->id.' was deleted successfully!');
        Application::$app->response->redirect('/admin?tab=comments');
    }
}
?>