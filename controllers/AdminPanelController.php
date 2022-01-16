<?php

namespace app\controllers;

use app\core\Controller;
use app\core\middlewares\AdminMiddleware;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AdminMiddleware(['adminPanel']));
    }

    public function adminPanel()
    {
        return $this->render('adminPanel');
    }
}