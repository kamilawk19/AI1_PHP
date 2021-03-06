<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Clients';
require_once Application::$ROOT_DIR . '/scripts/renderDbData.php';
?>
<div class="main_content">
    <h1>Clients</h1>
    <button id="new_form" class="buttons" type="button" value="0">New Client</button>
    <div id="form"></div>
    <?php
    if(isset($error))
    {
        if ($error == 0)
        {
            echo "<p class='text_err'>The client name must be at least 3 characters long</p>";
        }
        if ($error == -1)
        {
            echo "<p class='text_err'>You already have a client with that name!</p>";
        }
        unset($error);
    }
    ?>
    <h1>Clients:</h1>
    <div class="list">
        <?php
        renderData('clients');
        ?>
    </div>
</div>

<script type="text/javascript">

    function showForm()
    {
        let form = document.createElement("form");
        form.method="post";
        let divWithForm = document.querySelector('#form');
        divWithForm.appendChild(form);

        let name = document.createElement("input");
        let submitButton = document.createElement("button");
        let info = document.createElement("span");
        name.id = "timer_description";
        name.type = "text";
        name.name = "name";
        name.placeholder = "Entry a name";
        submitButton.id = "buttons";
        submitButton.type = "submit";
        submitButton.innerHTML = "Create";
        form.appendChild(name);
        form.appendChild(submitButton);
        form.appendChild(info);
    }
    let button = document.querySelector('#new_form');
    button.addEventListener('click', showForm, false);

</script>