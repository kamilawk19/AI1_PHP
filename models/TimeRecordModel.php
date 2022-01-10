<?php

namespace app\models;
use app\core\db\DbModel;
use app\core\Model;

class TimeRecordModel extends DbModel
{
    public int $user_id = 0;
    public string $task = '';
    public string $time = '';

    public static function tableName(): string
    {
        return 'completedTasks';
    }

    public function attributes(): array
    {
        return ['user_id', 'task', 'time'];
    }

    public function addRecord()
    {
        $primaryKey = \app\core\Application::$app->user->primaryKey();
        $this->user_id = \app\core\Application::$app->user->{$primaryKey};
        return parent::save();
    }
}