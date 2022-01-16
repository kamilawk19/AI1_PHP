<?php

class m0006_projects_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE projects (
                name VARCHAR(80) PRIMARY KEY,
                client_id INT,
                team_name VARCHAR(80),
                FOREIGN KEY (client_id) REFERENCES clients (client_id),
                FOREIGN KEY (team_name) REFERENCES teams (name),
                status TIME NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE projects;";
        $db->pdo->exec($SQL);
    }
}