<?php

namespace app\models;

use app\core\db\DbModel;

class UserProject extends DbModel
{
    public int $user_id = 0;
    public int $project_id = 0;

    public static function tableName(): string
    {
        return 'user_project';
    }

    public function attributes(): array
    {
        return ['user_id', 'project_id'];
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