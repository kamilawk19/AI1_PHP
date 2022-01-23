<?php

class m0010_add_user_roles
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN roles VARCHAR(512) NOT NULL");
        $db->pdo->exec("INSERT INTO users(id, email, firstname, lastname, status, created_at, password, roles) 
            values('9999', 'admin@zut.edu.pl', 'jaca', 'waca', '0', '2022-01-16 19:27:51'," . password_hash("asdf1235", PASSWORD_DEFAULT) . ",'user,admin')");
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN roles");
        $db->pdo->exec("DELETE FROM users WHERE id = 9999");
    }
}