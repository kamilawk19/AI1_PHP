<h1>Admin Panel</h1>

<?php
/** @var $this \app\core\View */

$this->title = 'Admin panel';

$sql = "SELECT * FROM tracker.users";
$stmt = \app\core\Application::$app->db->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_CLASS, "\app\models\User");

echo "Update user: ";

?>

<form method="get">
    Id  <input type="text" name="id"><br>
    Email <input type="text" name="email" /><br>
    Firstname <input type="text" name="firstname"><br>
    Lastname <input type="text" name="lastname"><br>
    Status <input type="text" name="status"><br>
    Created_at <input type="text" name="created_at"><br>
    Password <input type="text" name="password"><br>
    Roles <input type="text" name="roles">
    <input type="submit" name="submit" value="Update!" />
</form>

<?php

$update_id = $_GET['id'] ?? null;
$update_email = $_GET['email'] ?? null;;
$update_firstname = $_GET['firstname'] ?? null;
$update_lastname = $_GET['lastname'] ?? null;
$update_status = $_GET['status'] ?? null;
$update_created_at = $_GET['created_at'] ?? null;
$update_password = $_GET['password'] ?? null;
$update_roles = $_GET['roles'] ?? null;

$sql = "UPDATE users SET email=?, firstname=?, lastname=?, status=?, created_at=?, password=?, roles=? WHERE id=?";
$stmt = \app\core\Application::$app->db->prepare($sql);
$stmt->execute([$update_email, $update_firstname, $update_lastname, $update_status, $update_created_at, password_hash($update_password, PASSWORD_DEFAULT), $update_roles, $update_id]);

echo "<br>";

echo "Users: ";

foreach ($res as $user) {
    echo "<pre>";
    $foo = get_object_vars($user);
    echo $foo['id'] . ' ' . $foo['email'] . ' ' . $foo['firstname'] . ' ' . $foo['lastname'] . ' ' . $foo['status'] . ' ' . $foo['created_at'] . ' ' . $foo['roles'];
    echo "</pre>";
}

?>

