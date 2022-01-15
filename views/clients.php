<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Clients';
require_once Application::$ROOT_DIR . '/scripts/renderUserClientsOrTeams.php';
?>

<h1>Clients</h1>
<button id="new_form" type="button" style="width: 100px; height: 30px;" value="0">New Client</button>
<div id="form"></div>
<h3>clients:</h3>
<?php
renderClientsOrTeams('clients');
?>

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
        info.textContent = "  <-- zrobic walidacje pola";
        name.placeholder = "Entry a name";
        name.type = "text";
        name.name = "name";
        submitButton.type = "submit";
        submitButton.textContent = "Create";
        form.appendChild(name);
        form.appendChild(submitButton);
        form.appendChild(info);
    }
    let button = document.querySelector('#new_form');
    button.addEventListener('click', showForm, false);

</script>