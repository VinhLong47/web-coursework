<?php
use MVC\Form\Form;
?>

<h1>Login Form:</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'passEnter')->passwordField() ?>
    <button class="btn btn-outline-primary btn-lg">Login Account</button>
<?php Form::end() ?>