<?php

namespace app\models;

use app\core\db\DbModel;

class Project extends DbModel
{
    public string $name = '';
    public ?int $client_id = NULL;
    public ?string $team_name = '';
    public string $status = '';

    public static function tableName(): string
    {
        return 'projects';
    }

    public function attributes(): array
    {
        return ['name', 'client_id', 'team_name', 'status'];
    }

    public function addRecord()
    {
        $attribute = $this->attributes()[0];

        $name = $this->{$attribute};
        if(strlen($name) < 3) {
            return 0; //za krótki name dla projektu
        }

        $db = \app\core\Application::$app->db;
        $stm = $db->pdo->prepare("SELECT project_id FROM user_project WHERE user_id = ?");
        $primaryKey = \app\core\Application::$app->user->primaryKey();
        $this->user_id = \app\core\Application::$app->user->{$primaryKey};
        $stm->bindValue(1, $this->user_id);
        $stm->execute();
        $projects_ids = $stm->fetchAll();
        foreach ($projects_ids as $project_id) {
            $stm2 = $db->pdo->prepare("SELECT name FROM projects WHERE project_id = ?");
            $stm2->bindValue(1, $project_id['project_id']);
            $stm2->execute();
            $project_name = $stm2->fetch()['name'];
            if($name === $project_name) {
                return -1; //projekt o takim name już istnieje dla tego usera
            }
        }

        return parent::save();
    }
}
