<body class="box">
    <?php

    /** @var $model \app\models\LoginForm */
    /** @var $this \app\core\View */
    use app\core\form\Form;
    $this->title = 'Login';
    ?>

    <div class="container">
        <h1 class="form__title">Login</h1>
        <?php $form = Form::begin('', 'post') ?>
            <div class="form__input-group">
                <?php echo $form->field($model, 'email') ?>
            </div>
            <div class="form__input-group">
                <?php echo $form->field($model, 'password')->passwordField() ?>
            </div>
            <button class="form__button" type="submit">Submit</button>
        <?php Form::end() ?>
    </div>
</body>