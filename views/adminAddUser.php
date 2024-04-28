<?php

use MVC\Form\Form;

$form = new Form();
?>

<section class="main-content">
    <h2 style="text-align: center;">Add A User</h2>

    <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'pass')->passwordField() ?>
        <?php echo $form->field($model, 'passConfirm')->passwordField() ?>
        <div class="row">
            <div class="col-2">
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="isAdminChecked" name="is_admin" <?=$model->is_admin ? 'checked' : ''?>>
                    <label class="form-check-label" for="isAdminChecked">Admin</label>
                </div>
            </div>
        </div>

        <button class="btn btn-success mb-2 mt-2" type="submit">Submit</button>
    <?php Form::end() ?>
</section>

<script>
    
</script>