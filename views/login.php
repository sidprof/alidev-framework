<h1>Login Page</h1>
<?php $form = \app\core\form\Form::begin("", "POST"); ?>
<?php echo $form->inputField("email", $model)->inputGroup('envelope'); ?>
<?php echo $form->inputField("password", $model)->passwordType()->inputGroup('lock'); ?>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
<?php $form->end(); ?>