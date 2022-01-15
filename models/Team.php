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
        return parent::save();
    }
}