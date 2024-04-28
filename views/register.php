<?php

use MVC\Form\Form;

$form = new Form();
?>

<h1>Create an Account:</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'username') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'pass')->passwordField() ?>
    <?php echo $form->field($model, 'passConfirm')->passwordField() ?>
    <button class="btn btn-outline-primary btn-lg">Register Account</button>
<?php Form::end() ?>