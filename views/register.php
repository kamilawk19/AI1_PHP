<body class="box">
    <?php
    /** @var $model \app\core\Model */
    /** @var $this \app\core\View */

    use app\core\form\Form;

    $this->title = 'Registration';
    $form = new Form();
    ?>
    <div class="container">
        <h1 class="form__title">Register</h1>

        <?php $form = Form::begin('', 'post') ?>
        <div class="form__input-group">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="form__input-group">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
        <div class="form__input-group">
            <?php echo $form->field($model, 'email') ?>
        </div>
        <div class="form__input-group">
            <?php echo $form->field($model, 'password')->passwordField() ?>
        </div>
        <div class="form__input-group">
            <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
        </div>
        <button class="form__button" type="submit">Submit</button>
        <?php Form::end() ?>
    </div>
</body>