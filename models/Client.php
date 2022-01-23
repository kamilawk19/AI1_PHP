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
        $attribute = $this->attributes()[0];

        $name = $this->{$attribute};
        if(strlen($name) < 3) {
            return 0; //za krótki name dla klienta
        }

        $db = \app\core\Application::$app->db;
        $stm = $db->pdo->prepare("SELECT client_id FROM user_client WHERE user_id = ?");
        $primaryKey = \app\core\Application::$app->user->primaryKey();
        $this->user_id = \app\core\Application::$app->user->{$primaryKey};
        $stm->bindValue(1, $this->user_id);
        $stm->execute();
        $clients_ids = $stm->fetchAll();
        foreach ($clients_ids as $client_id) {
            $stm2 = $db->pdo->prepare("SELECT name FROM clients WHERE client_id = ?");
            $stm2->bindValue(1, $client_id['client_id']);
            $stm2->execute();
            $client_name = $stm2->fetch()['name'];
            if($name === $client_name) {
                return -1; //klient o takim name już istnieje dla tego usera
            }
        }

        return parent::save();
    }
}