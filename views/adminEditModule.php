<?php

use MVC\Form\Form;

$form = new Form();
?>

<section class="main-content">
    <h2 style="text-align: center;">Edit Module</h2>

    <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'name') ?>
        <button class="btn btn-success mb-2 mt-2" type="submit">Submit</button>
    <?php Form::end() ?>
</section>