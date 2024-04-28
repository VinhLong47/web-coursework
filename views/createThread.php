<?php 

use MVC\Form\ThreadForm;

$form = new ThreadForm();
?>

<h1>Create Thread</h1>

<?php $form = ThreadForm::begin('', 'post') ?>
    <?php echo $form->field($model, 'name') ?>
    <label for="dataList">Select A Module</label>
    <select class="form-select" id="dataList" aria-label="Default select example" name="module_id" required>
         <?php foreach($modules as $module): ?>
            <option value="<?=$module['id']?>"><?=$module['name']?></option>
        <?php endforeach ?>
    </select>
    <?php echo $form->textField($model, 'description') ?>
    <?php echo $form->field($model, 'img')->imageField() ?>

    <button class="btn btn-outline-primary btn-lg mb-4" type="submit">Submit</button>
<?php ThreadForm::end() ?>