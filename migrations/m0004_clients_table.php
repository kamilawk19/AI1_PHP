<?php

class m0004_clients_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE clients(
                client_id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(80) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE clients;";
        $db->pdo->exec($SQL);
    }
}