<?php

$first_name = array(
		'name'	=> 'first_name',
		'id'	=> 'first_name',
		'value'	=> set_value('first_name'),
		'maxlength'	=> 80,
		'size'	=> 30,
		'class' =>'form-control',
		'placeholder' => 'First Name',
		'autofocus'   => 'autofocus',
);
$last_name = array(
		'name'	=> 'last_name',
		'id'	=> 'last_name',
		'value'	=> set_value('last_name'),
		'maxlength'	=> 80,
		'size'	=> 30,
		'class' =>'form-control',
		'placeholder' => 'Last Name',
);
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class' =>'form-control',
		'placeholder' => 'Username',
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' =>'form-control',
	'placeholder' => 'Email Address',
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'class' =>'form-control',
);

$roles_options=array();
function array_push_assoc($array, $key, $value){
	$array[$key] = $value;
	return $array;
}

foreach($roles as $role){
	$roles_options=array_push_assoc($roles_options, $role->id, $role->role);
}



?>


<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header">Add New Admin</h1>
		</div>
	</div>

        <div class="row">
            <div class="col-xs-12">
            <?php echo form_open($this->uri->uri_string()); ?>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <?php echo form_submit('register', 'Save New Admin','class="btn btn-success pull-right "'); ?>
                        <a href="<?php echo base_url('admin')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
                    </div>
                    <div class="panel-body">

                            <fieldset>
                                <div class="form-group">
                                	<?php echo form_label('First Name', $first_name['id']); ?>
                                    <?php echo form_input($first_name); ?>
                                    <div class="alert-danger"><?php echo form_error($first_name['name']); ?><?php echo isset($errors[$first_name['name']])?$errors[$first_name['name']]:''; ?></div>
                                </div>
                                <div class="form-group">
                                	<?php echo form_label('Last Name', $last_name['id']); ?>
                                    <?php echo form_input($last_name); ?>
                                    <div class="alert-danger"><?php echo form_error($last_name['name']); ?><?php echo isset($errors[$last_name['name']])?$errors[$last_name['name']]:''; ?></div>
                                </div>
                            	<?php if ($use_username) { ?>
                                <div class="form-group">
                                	<?php echo form_label('Username', $username['id']); ?>
                                    <?php echo form_input($username); ?>
                                    <div class="alert-danger"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></div>
                                </div>
								<?php } ?>
                                <div class="form-group">
                                	<?php echo form_label('Email Address', $email['id']); ?>
                                    <?php echo form_input($email); ?>
                                    <div class="alert-danger"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></div>
                                </div>


                                <div class="form-group">
                               		<?php echo form_label('User Role'); ?>
									<?php
										$default_select = set_value('role');
										echo form_dropdown('role', $roles_options, $default_select, 'class="form-control" id="roles"');
									 ?>
								</div>

                                <div class="form-group">
		                            <?php if ($captcha_registration) {
								 		if ($use_recaptcha) { ?>
											<div id="recaptcha_image"></div>
											<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
											<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
											<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
											<div class="recaptcha_only_if_image">Enter the words above</div>
											<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
											<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class ="form-control"/>
											<div class="alert-danger"><?php echo form_error('recaptcha_response_field'); ?></div>
											<?php echo $recaptcha_html; ?>
									<?php } else { ?>
										<p>Enter the code exactly as it appears:</p>
										<?php echo $captcha_html; ?>
										<?php echo form_label('Confirmation Code', $captcha['id']); ?>
										<?php echo form_input($captcha); ?>
										<div class="alert-danger"><?php echo form_error($captcha['name']); ?></div>
									<?php }
								 	} ?>
                                </div>









                            </fieldset>









                    </div>
                </div>
            <?php echo form_close(); ?>
            </div>
        </div>
</div>














