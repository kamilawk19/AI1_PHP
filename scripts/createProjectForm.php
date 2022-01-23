<?php

function create_form()
{
    $db = \app\core\Application::$app->db;
    $stm = $db->pdo->prepare("SELECT client_id FROM user_client WHERE user_id = ?");
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};
    $stm->bindValue(1, $value);
    $stm->execute();
    $in_array[] = null;
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $in_array[] = $row['client_id'];
    }
    \array_splice($in_array, 0, 1);
    if (count($in_array) > 0) {
        $in = str_repeat('?,', count($in_array) - 1) . '?';
        $sql = "SELECT client_id, name FROM clients WHERE client_id IN ($in)";
        $stm2 = $db->prepare($sql);
        $stm2->execute($in_array);
        $rows = $stm2->fetchAll();
    }

    $stm3 = $db->pdo->prepare("SELECT team_name FROM user_team WHERE user_id = ?");
    $primaryKey = \app\core\Application::$app->user->primaryKey();
    $value = \app\core\Application::$app->user->{$primaryKey};
    $stm3->bindValue(1, $value);
    $stm3->execute();

    $rows2 = $stm3->fetchAll();

    echo '<form method="post">';
    echo '<input type="text" name="name" placeholder="Entry a name"><br>';

    echo '<select class="ddl" name="client_id">';
    echo '<option value="0">no client</option>';

    foreach ($rows as $row) {
        echo '<option value="' . $row['client_id'] . '">' . $row['name'] . '</option>';
    }

    echo '</select>';

    echo '<select class="ddl" name="team_name">';
    echo '<option value="null">no team</option>';

    foreach ($rows2 as $row) {
        echo '<option value="' . $row['team_name'] . '">' . $row['team_name'] . '</option>';
    }

    echo '</select>';
    echo '<button class="ddl" type="submit">Create</button>';
    echo '</form>';
}