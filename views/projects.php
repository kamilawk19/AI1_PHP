<?php
/** @var $model \app\core\Model */
/** @var $this \app\core\View */
use app\core\form\Form;

$this->title = 'Projects';
?>

<h1>Projects page</h1>
<button id="new_project" type="button" style="width: 100px; height: 30px;">New project</button>
<h3>projects:</h3>

<script type="text/javascript">

    function showForm()
    {
        console.log("xd");
    }

    let button = document.querySelector('#new_project');
    button.addEventListener("click", showForm, false);

</script>