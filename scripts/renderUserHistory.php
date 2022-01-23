<?php
function renderHistory()
{
    $db = \app\core\Application::$app->db;
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};

    $stm = $db->pdo->prepare("SELECT task, project_id, time, created_at FROM completedtasks WHERE user_id = ?");
    $stm->bindValue(1, $value);
    $stm->execute();

    $history = $stm->fetchAll();
    $nr = 1;

    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>no</div>";
    foreach ($history as $row) {
        echo "<div class='history_record'>$nr</div>";
        $nr++;
    }
    echo "</div>";
    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>task description</div>";
    foreach ($history as $row) {
        echo "<div class='history_record'>$row[0]</div>";
    }
    echo "</div>";
    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>project</div>";
    foreach ($history as $row) {
        $stm2 = $db->pdo->prepare("SELECT name FROM projects WHERE project_id = ?");
        $stm2->bindValue(1, $row[1]);
        $stm2->execute();
        if (!$project_name = $stm2->fetch()){
            $project_name = "------";
        } else {
            $project_name = $project_name['name'];
        }
        echo "<div class='history_record'>$project_name</div>";
    }
    echo "</div>";
    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>client</div>";
    foreach ($history as $row) {
        $stm3 = $db->pdo->prepare("SELECT client_id FROM projects WHERE project_id = ?");
        $stm3->bindValue(1, $row[1]);
        $stm3->execute();
        $client_name = "------";
        if ($client_id = $stm3->fetch() != null){
            $stm4 = $db->pdo->prepare("SELECT name FROM clients WHERE client_id = ?");
            $stm4->bindValue(1, $client_id);
            $stm4->execute();
            $client_name = $stm4->fetch()["name"];
        }
        echo "<div class='history_record'>$client_name</div>";
    }

    echo "</div>";
    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>time</div>";
    foreach ($history as $row) {
        echo "<div class='history_record'>$row[2]</div>";
    }
    echo "</div>";
    echo "<div class='history_rec_col'>";
    echo "<div class='history_record history_record_title'>date</div>";
    foreach ($history as $row) {
        $date = substr($row[3], 0, 10);
        echo "<div class='history_record'>$date</div>";
    }
    echo "</div>";
}
?>
