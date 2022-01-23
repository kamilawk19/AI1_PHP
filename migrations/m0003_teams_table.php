<?php

class m0003_teams_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE teams (
                name VARCHAR(80) PRIMARY KEY,
                members INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE teams;";
        $db->pdo->exec($SQL);
    }
}