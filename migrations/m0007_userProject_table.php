<?php

class m0007_userProject_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE user_project (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                project_id INT NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (project_id) REFERENCES projects (project_id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE user_project;";
        $db->pdo->exec($SQL);
    }
}