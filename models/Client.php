<?php

namespace app\models;

use app\core\db\DbModel;

class Client extends DbModel
{
    public string $name = '';

    public static function tableName(): string
    {
        return 'clients';
    }

    public function attributes(): array
    {
        return ['name'];
    }

    public function addRecord()
    {
        return parent::save();
    }
}