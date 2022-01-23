<?php
/* $obiect - choose whether to render Clients or Teams */
function renderData($obiect)
{
    $db = \app\core\Application::$app->db;
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};

    if ($obiect == "clients") {
        $stm = $db->pdo->prepare("SELECT name FROM clients
                                        JOIN user_client ON clients.client_id = user_client.client_id
                                        WHERE user_client.user_id = ?;");
    }
    if ($obiect == "teams") {
        $stm = $db->pdo->prepare("SELECT name FROM teams
                                        JOIN user_team ON teams.name = user_team.team_name
                                        WHERE user_team.user_id = ?;");
    }

    if ($obiect == "projects") {
        $stm = $db->pdo->prepare("SELECT name, client_id, team_name, status FROM projects
                                        JOIN user_project ON projects.project_id = user_project.project_id
                                        WHERE user_project.user_id = ?;");
    }

    $stm->bindValue(1, $value);
    $stm->execute();

    $data = $stm->fetchAll();
    $nr = 1;

    if ($obiect == "projects") {
        echo "<div class='history_rec_col'>";
        echo "<div class='history_record history_record_title'>no</div>";
        foreach ($data as $row) {
            echo "<div class='history_record'>$nr</div>";
            $nr++;
        }
        echo "</div>";
        echo "<div class='history_rec_col'>";
        echo "<div class='history_record history_record_title'>project name</div>";
        foreach ($data as $row) {
            echo "<div class='history_record'>$row[0]</div>";
        }
        echo "</div>";
        echo "<div class='history_rec_col'>";
        echo "<div class='history_record history_record_title'>client</div>";
        foreach ($data as $row) {
            if ($row[1] == null) {
                echo "<div class='history_record'>---</div>";
            } else {
                $stm2 = $db->pdo->prepare("SELECT name FROM clients WHERE client_id = ?");
                $stm2->bindValue(1, $row[1]);
                $stm2->execute();
                $client_name = $stm2->fetch()["name"];
                echo "<div class='history_record'>$client_name</div>";
            }
        }
        echo "</div>";
        echo "<div class='history_rec_col'>";
        echo "<div class='history_record history_record_title'>team</div>";
        foreach ($data as $row) {
            if ($row[2] == null) {
                echo "<div class='history_record'>---</div>";
            } else {
                echo "<div class='history_record'>$row[2]</div>";
            }
        }
        echo "</div>";
        echo "<div class='history_rec_col'>";
        echo "<div class='history_record history_record_title'>status</div>";
        foreach ($data as $row) {
            echo "<div class='history_record'>$row[3]</div>";
        }
        echo "</div>";

    } else {
        foreach ($data as $row) {
            echo "<div class='history_record'>$nr. $row[0]</div>";
            $nr++;
        }
    }
}
?>