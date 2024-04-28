<?php
use MVC\Controllers\HomeController;
use MVC\Controllers\LoginController;
use MVC\Controllers\RegisterController;
use MVC\Controllers\ThreadController;
use MVC\Controllers\ProfileController;
use MVC\Controllers\ModuleController;
use MVC\Controllers\AdminController;
use MVC\Controllers\ContactController;



use MVC\Core\Application;


require_once __DIR__ . '/../autoloader.php';
(new MVC\Core\DotEnv(__DIR__ . '/../.env'))->load();

$config = [
    'userClass' => \MVC\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'home']);


$app->router->get('/register', [RegisterController::class, 'register']);
$app->router->post('/register', [RegisterController::class, 'register']);


$app->router->get('/login', [LoginController::class, 'login']);
$app->router->get('/login/{id}', [LoginController::class, 'login']);
$app->router->post('/login', [LoginController::class, 'login']);
$app->router->get('/logout', [LoginController::class, 'logout']);


$app->router->get('/contact', [ContactController::class, 'create']);
$app->router->post('/contact', [ContactController::class, 'create']);

$app->router->get('/threads', [ThreadController::class, 'threads']);
$app->router->post("/threads/{id}/edit", [ThreadController::class, 'editThread']);
$app->router->get("/threads/{id}/delete", [ThreadController::class, 'deleteThread']);

$app->router->get('/thread', [ThreadController::class, 'thread']);
$app->router->post('/thread', [ThreadController::class, 'thread']);
$app->router->get('/threads/{id}', [ThreadController::class, 'detail']);
$app->router->post('/threads/{id}/comment', [ThreadController::class, 'comment']);

$app->router->get('/module', [ModuleController::class, 'module']);

$app->router->get('/profile', [ProfileController::class, 'profile']);
$app->router->get('/profile/{id:\d+}/{username}', [ProfileController::class, 'login']);

$app->router->get("admin", [AdminController::class, 'index']);

$app->router->get("admin/modules/add", [AdminController::class, 'addModule']);
$app->router->post("admin/modules/add", [AdminController::class, 'addModule']);

$app->router->get("admin/modules/{id}/edit", [AdminController::class, 'editModule']);
$app->router->post("admin/modules/{id}/edit", [AdminController::class, 'editModule']);
$app->router->get("admin/modules/{id}/delete", [AdminController::class, 'deleteModule']);

$app->router->get("admin/users/add", [AdminController::class, 'addUser']);
$app->router->post("admin/users/add", [AdminController::class, 'addUser']);

$app->router->get("admin/users/{id}/edit", [AdminController::class, 'editUser']);
$app->router->post("admin/users/{id}/edit", [AdminController::class, 'editUser']);
$app->router->get("admin/users/{id}/delete", [AdminController::class, 'deleteUser']);

$app->router->get("/admin/threads/{id}/delete", [AdminController::class, 'deleteThread']);
$app->router->get("/admin/contacts/{id}/delete", [AdminController::class, 'deleteContact']);
$app->router->get("/admin/comments/{id}/delete", [AdminController::class, 'deleteComment']);

$app->run(); 
