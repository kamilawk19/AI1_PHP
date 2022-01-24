<?php
/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Team';
require_once Application::$ROOT_DIR . '/scripts/renderDbData.php';
?>
<div class="main_content">
    <h1>Team</h1>
    <button id="new_form" class="buttons" type="button" value="0">New team</button>
    <div id="form"></div>
    <?php
    if(isset($error))
    {
        if ($error == 0)
        {
            echo "<p class='text_err'>The team name must be at least 3 characters long</p>";
        }
        if ($error == -1)
        {
            echo "<p class='text_err'>A team with that name already exists! Please choose a different name</p>";
        }
        unset($error);
    }
    ?>
    <h1>Teams:</h1>
    <div class="list">
        <?php
        renderData('teams');
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
        submitButton.textContent = "Create";
        form.appendChild(name);
        form.appendChild(submitButton);
        form.appendChild(info);
    }

    function showTeamOptions(e)
    {
        let block = document.createElement("div");
        block.id = "team_options";
        let exit = document.createElement("button");
        exit.id = "exit_button";
        exit.textContent = "X"
        exit.addEventListener("click", function(){
            document.body.removeChild(block)
            for (const team of teams) {
                team.classList.add("team_record");
                team.addEventListener('click', showTeamOptions);
            }
        })
        let info = document.createElement("p");
        info.textContent = "Tutaj ma być zarządzanie teamem, ilośc członków, wyszukiwanie użytkowników w systemie i ich dodawanie. Nie zdążyłem jeszcze tego zrobić";
        block.appendChild(exit);
        block.appendChild(info);
        document.body.appendChild(block);

        for (const team of teams) {
            team.classList.add("team_record");
            team.removeEventListener('click', showTeamOptions);
        }
    }

    let button = document.querySelector('#new_form');
    button.addEventListener('click', showForm, false);

    var teams = document.querySelectorAll(".history_record");
    for (const team of teams) {
        team.classList.add("team_record");
        team.addEventListener('click', showTeamOptions, false);
    }

</script>