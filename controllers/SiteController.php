<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Client;
use app\models\LoginForm;
use app\models\Team;
use app\models\TimeRecordModel;
use app\models\User;
use app\models\UserClient;
use app\models\UserTeam;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        $this->registerMiddleware(new AuthMiddleware(['timer']));
        $this->registerMiddleware(new AuthMiddleware(['projects']));
        $this->registerMiddleware(new AuthMiddleware(['clients']));
        $this->registerMiddleware(new AuthMiddleware(['team']));
    }

    public function home()
    {
        return $this->render('home', [
            'name' => 'Jaca'
        ]);
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                return 'Show success page';
            }

        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function timer(Request $request)
    {
        if ($request->isPost())
        {
            $timeRecord = new TimeRecordModel();
            $timeRecord->loadData($request->getBody());
            if($timeRecord->addRecord())
            {
                Application::$app->response->redirect('/timer');
            }
        }
        return $this->render('timer');
    }

    public function clients(Request $request)
    {
        if ($request->isPost())
        {
            $clientRecord = new Client();
            $userClientRecord = new UserClient();
            $clientRecord->loadData($request->getBody());
            if($clientRecord->addRecord())
            {
                $db = \app\core\Application::$app->db;
                $stm = $db->pdo->prepare("SELECT client_id FROM clients WHERE name = ?");
                $stm->bindValue(1, $clientRecord->name);
                $stm->execute();
                $id = $stm->fetch()["client_id"];
                $userClientRecord->client_id = $id;
                if($userClientRecord->addRecord()) {
                    Application::$app->response->redirect('/clients');
                }
            }
        }
        return $this->render('clients');
    }

    public function team(Request $request)
    {
        if ($request->isPost())
        {
            $teamRecord = new Team();
            $userTeamRecord = new UserTeam();
            $teamRecord->loadData($request->getBody());

            if($teamRecord->addRecord())
            {
                $userTeamRecord->team_name = $teamRecord->name;
                if($userTeamRecord->addRecord()) {
                    Application::$app->response->redirect('/team');
                }
            }
        }
        return $this->render('team');
    }

    public function projects()
    {
        return $this->render('projects');
    }
}