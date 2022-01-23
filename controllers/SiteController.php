<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Client;
use app\models\LoginForm;
use app\models\Project;
use app\models\Team;
use app\models\TimeRecordModel;
use app\models\User;
use app\models\UserClient;
use app\models\UserProject;
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
            if($timeRecord->project_id == 0)
            {
                $timeRecord->project_id = null;
            }
            if($timeRecord->addRecord())
            {
                if($timeRecord->project_id != null) {
                    $db = \app\core\Application::$app->db;
                    $stm = $db->pdo->prepare('UPDATE projects SET status = ADDTIME(status, ?) WHERE project_id = ?');
                    $stm->bindValue(1, $timeRecord->time);
                    $stm->bindValue(2, $timeRecord->project_id);
                    $stm->execute();
                }
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
            $result = $clientRecord->addRecord();

            if($result === true)
            {
                $db = \app\core\Application::$app->db;
                $stm = $db->pdo->prepare("SELECT client_id FROM clients WHERE name = ?");
                $stm->bindValue(1, $clientRecord->name);
                $stm->execute();
                $temp = $stm->fetchAll();
                $id = end($temp)["client_id"];
                $userClientRecord->client_id = $id;
                if($userClientRecord->addRecord()) {
                    Application::$app->response->redirect('/clients');
                }
            }
            else
            {
                return $this->render('clients', ['error' => $result]);
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
            $result = $teamRecord->addRecord();
            if($result === true)
            {
                $userTeamRecord->team_name = $teamRecord->name;
                if($userTeamRecord->addRecord()) {
                    Application::$app->response->redirect('/team');
                }
            }
            else
            {
                return $this->render('team', ['error' => $result]);
            }
        }
        return $this->render('team');
    }

    public function projects(Request $request)
    {
        if ($request->isPost())
        {
            $projectRecord = new Project();
            $userProjectRecord = new UserProject();
            $projectRecord->loadData($request->getBody());
            if($projectRecord->client_id == 0)
            {
                $projectRecord->client_id = null;
            }
            if($projectRecord->team_name == "null")
            {
                $projectRecord->team_name = null;
            }
            $result = $projectRecord->addRecord();
            if($result === true)
            {
                $db = \app\core\Application::$app->db;
                $stm = $db->pdo->prepare("SELECT project_id FROM projects WHERE name = ?");
                $stm->bindValue(1, $projectRecord->name);
                $stm->execute();
                $temp = $stm->fetchAll();
                $id = end($temp)["project_id"];
                $userProjectRecord->project_id = $id;
                if($userProjectRecord->addRecord()) {
                    Application::$app->response->redirect('/projects');
                }
            }
            else
            {
                return $this->render('projects', ['error' => $result]);
            }
        }
        return $this->render('projects');
    }
}