<?php
/** @var $model \app\core\Model */
/** @var $this \app\core\View */

use app\core\form\Form;

$this->title = 'Registration';
$form = new Form();
?>

<h1>Register</h1>

<?php $form = Form::begin('', 'post') ?>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
    <button>Submit</button>
<?php Form::end() ?>