<?php
/* $obiect - choose whether to render Clients or Teams */
function renderClientsOrTeams($obiect)
{
    $db = \app\core\Application::$app->db;
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};

    if($obiect == "clients") {
        $stm = $db->pdo->prepare("SELECT name FROM clients
                                        JOIN user_client ON clients.client_id = user_client.client_id
                                        WHERE user_client.user_id = ?;");
    }
    if($obiect == "teams"){
        $stm = $db->pdo->prepare("SELECT name FROM teams
                                        JOIN user_team ON teams.name = user_team.team_name
                                        WHERE user_team.user_id = ?;");
    }

    $stm->bindValue(1, $value);
    $stm->execute();

    $data = $stm->fetchAll();
    $nr = 1;

    foreach ($data as $row) {
        echo "<div> $nr. $row[0]</div>";
        $nr++;
    }
}
?>