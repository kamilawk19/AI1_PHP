<?php

use app\controllers\AboutController;
use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'userClass' => \app\models\User::class,
    "db" => [
        "dsn" => "mysql:host=localhost;port=3306;dbname=tracker",
        "user" => "root",
        "password" => ""
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->on(Application::EVENT_BEFORE_REQUEST, function() {
    echo "Before request from second installation";
});

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [SiteController::class, 'register']);
$app->router->get('/login', [SiteController::class, 'login']);
$app->router->post('/login', [SiteController::class, 'login']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [AboutController::class, 'index']);
$app->router->get('/profile', [SiteController::class, 'profile']);
$app->router->get('/timer', [SiteController::class, 'timer']);
$app->router->post('/timer', [SiteController::class, 'timer']);

$app->run();