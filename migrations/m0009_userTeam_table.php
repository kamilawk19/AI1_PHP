<?php

class m0009_userTeam_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE user_team (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                team_name VARCHAR(80) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (team_name) REFERENCES teams (name),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE user_team;";
        $db->pdo->exec($SQL);
    }
}