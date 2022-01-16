<?php
function renderHistory()
{
    $db = \app\core\Application::$app->db;
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};

    $stm = $db->pdo->prepare("SELECT task, time, created_at FROM completedtasks WHERE user_id = ?");
    $stm->bindValue(1, $value);
    $stm->execute();

    $history = $stm->fetchAll();
    $nr = 1;

    foreach ($history as $row) {
        $date = substr($row[2], 0, 10);
        echo "<div> $nr. $row[0], $row[1], $date  </div>";
        $nr++;
    }
}
?>
