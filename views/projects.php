<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Projects';
require_once Application::$ROOT_DIR . '/scripts/createProjectForm.php';
require_once Application::$ROOT_DIR . '/scripts/renderDbData.php';
?>
<div class="main_content">
    <h1>Projects page</h1>
    <button id="new_form" class="buttons" type="button" style="width: 150px;">New project</button>
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
            echo "<p class='text_err'>The project name must be at least 3 characters long</p>";
        }
        if ($error == -1)
        {
            echo "<p class='text_err'>You already have a project with that name!</p>";
        }
        unset($error);
    }
    ?>

    <h1>Projects:</h1>
    <div class="list">
        <?php
        renderData('projects');
        ?>
    </div>
</div>

<script type="text/javascript">

    function showForm()
    {
        let form = document.querySelector('#form');
        form.style.display = "block";
    }
    let button = document.querySelector('#new_form');
    button.addEventListener('click', showForm, false);

</script>