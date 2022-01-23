<?php

namespace app\models;

use app\core\db\DbModel;

class Team extends DbModel
{
    public string $name = '';
    public int $members = 1;

    public static function tableName(): string
    {
        return 'teams';
    }

    public function attributes(): array
    {
        return ['name', 'members'];
    }

    public function addRecord()
    {
        $attribute = $this->attributes()[0];

        $name = $this->{$attribute};
        if(strlen($name) < 3) {
            return 0; //za krótki name dla teamu
        }

        $db = \app\core\Application::$app->db;
        $stm = $db->pdo->prepare("SELECT name FROM teams WHERE name = ?");
        $stm->bindValue(1, $name);
        $stm->execute();
        $teams_names = $stm->fetchAll();
        foreach ($teams_names as $team_name) {
            return -1; //team o takim name już istnieje
        }

        return parent::save();
    }
}