<?php

use MVC\Form\Form;
use MVC\Core\Application;

$form = new Form();
?>

<section class="main-content">
    <h2 style="text-align: center;">Contact Us</h2>

    <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'subject') ?>
        <?php echo $form->textField($model, 'message') ?>
        <?php if (!Application::$app->isGuest()): ?>
            <input type="hidden" name="email" value="<?=Application::$app->user->email?>"/>
        <?php else: ?>
            <?php echo $form->field($model, 'email') ?>
        <?php endif ?>
        <button class="btn btn-success mb-2 mt-2" type="submit">Submit</button>
    <?php Form::end() ?>
</section>

<script>
    
</script>