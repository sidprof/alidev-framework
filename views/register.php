<?php $this->title = "Register Page"; ?>
<h1>Registration Page</h1>
<?php $form = app\core\form\Form::begin("", "POST"); ?>
    <?php echo $form->inputField("firstname", $model); ?>
    <?php echo $form->inputField("lastname", $model); ?>
    <?php echo $form->inputField("email", $model); ?>
    <?php echo $form->inputField("password", $model)->passwordType(); ?>
    <?php echo $form->inputField("confirmPassword", $model)->passwordType(); ?>
    <button type="submit" name="submit" class="btn btn-primary">submit</button>
<?php echo $form->end(); ?>