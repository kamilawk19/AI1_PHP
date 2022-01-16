<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Home page';
?>

<?php if (Application::isGuest()): ?>
    <h1>Welcome</h1>

<?php else: ?>
    <h1>Welcome <?php echo Application::$app->user->getDisplayFirstName() ?></h1>
<?php endif; ?>