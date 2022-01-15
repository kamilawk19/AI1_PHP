<?php

namespace app\models;

use app\core\db\DbModel;

class UserClient extends DbModel
{
    public int $user_id = 0;
    public int $client_id = 0;

    public static function tableName(): string
    {
        return 'user_client';
    }

    public function attributes(): array
    {
        return ['user_id', 'client_id'];
    }

    public function addRecord()
    {
        $primaryKey = \app\core\Application::$app->user->primaryKey();
        $this->user_id = \app\core\Application::$app->user->{$primaryKey};
        return parent::save();
    }
}
