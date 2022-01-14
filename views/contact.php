<h1>Contact Us</h1>
<?php $form = app\core\form\Form::begin("", "POST"); ?>
<?php echo $form->inputField("subject", $model); ?>
<?php echo $form->inputField("email", $model); ?>
<?php echo $form->textareaField("body", $model); ?>
<button type="submit" class="btn btn-primary" >Submit</button>
<?php echo $form->end(); ?>