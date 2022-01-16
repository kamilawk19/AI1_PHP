<?php

use app\core\Application;

require_once __DIR__.'/vendor/autoload.php';

$config = [
    'userClass' => \app\models\User::class,
    "db" => [
        "dsn" => "mysql:host=localhost;port=3306;dbname=tracker",
        "user" => "root",
        "password" => "asdf1235"
    ]
];
$app = new Application(__DIR__, $config);

$app->db->applyMigrations();