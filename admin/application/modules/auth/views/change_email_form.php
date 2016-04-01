<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' =>'form-control',
	'placeholder' => 'Password',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' =>'form-control',
	'placeholder' => 'New Email',
);
?>





<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header">Change Email</h1>
		</div>
	</div>
    <div class="row">
    	<?php echo form_open($this->uri->uri_string()); ?>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <?php echo form_submit('change', 'Send confirmation email','class="btn btn-md btn-success pull-right"'); ?>
                    </div>
                    <div class="panel-body">

                            <fieldset>
                                <div class="form-group">
                                	<?php echo form_label('Password', $password['id']); ?>
                                    <?php echo form_password($password); ?>
                                    <div class="alert-danger"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></div>
                                </div>
                                <div class="form-group">
                                	<?php echo form_label('New email address', $email['id']); ?>
                                    <?php echo form_input($email); ?>
                                    <div class="alert-danger"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></div>
                                </div>


                            </fieldset>

                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>








