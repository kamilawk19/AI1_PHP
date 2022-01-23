<?php

function showProjectsList()
{
    $db = \app\core\Application::$app->db;
    $stm = $db->pdo->prepare("SELECT project_id FROM user_project WHERE user_id = ?");
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};
    $stm->bindValue(1, $value);
    $stm->execute();
    $in_array[] = null;
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $in_array[] = $row['project_id'];
    }
    \array_splice($in_array, 0, 1);
    if (count($in_array) > 0) {
        $in = str_repeat('?,', count($in_array) - 1) . '?';
        $sql = "SELECT project_id, name FROM projects WHERE project_id IN ($in)";
        $stm2 = $db->prepare($sql);
        $stm2->execute($in_array);
        $rows = $stm2->fetchAll();
    }

    echo '<select id="ddl_timer" name="project_id">';
    echo '<option value="0">no project</option>';

    foreach ($rows as $row) {
        echo '<option value="' . $row['project_id'] . '">' . $row['name'] . '</option>';
    }

    echo '</select>';
}
