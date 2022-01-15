<?php

namespace app\models;

use app\core\db\DbModel;

class UserTeam extends DbModel
{
    public int $user_id = 0;
    public string $team_name = '';

    public static function tableName(): string
    {
        return 'user_team';
    }

    public function attributes(): array
    {
        return ['user_id', 'team_name'];
    }

    public function addRecord($addUser=false)
    {
        if ($addUser == false)
        {
            $primaryKey = \app\core\Application::$app->user->primaryKey();
            $this->user_id = \app\core\Application::$app->user->{$primaryKey};
        }

        return parent::save();
    }
}
