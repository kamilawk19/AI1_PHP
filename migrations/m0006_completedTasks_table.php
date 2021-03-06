<?php

class m0006_completedTasks_table
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE completedTasks (
                task_id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                project_id INT NULL,
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (project_id) REFERENCES projects (project_id),
                task VARCHAR(255),
                time VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE completedTasks;";
        $db->pdo->exec($SQL);
    }
}