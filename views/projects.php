<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Projects';
require_once Application::$ROOT_DIR . '/scripts/createProjectForm.php';
require_once Application::$ROOT_DIR . '/scripts/renderDbData.php';
?>

<h1>Projects page</h1>
<button id="new_form" type="button" style="width: 100px; height: 30px;">New project</button>
<div id="form" style="display: none;">
    <?php
    create_form();
    ?>
</div>
<?php
if(isset($error))
{
    if ($error == 0)
    {
        echo "<p class='text_err'>Nazwa projekut musi składać się przynajmniej z 3 znaków</p>";
    }
    if ($error == -1)
    {
        echo "<p class='text_err'>Masz już projekt o takiej nazwie!</p>";
    }
    unset($error);
}
?>
<h3>projects:</h3>
<?php
renderData('projects');
?>

<script type="text/javascript">

    function showForm()
    {
        let form = document.querySelector('#form');
        form.style.display = "block";
    }
    let button = document.querySelector('#new_form');
    button.addEventListener('click', showForm, false);

</script>