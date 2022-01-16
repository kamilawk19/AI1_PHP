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
        return parent::save();
    }

}
