<?php
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' =>'form-control',
	'autofocus'   => 'autofocus',
	'placeholder' => $login_label,
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' =>'form-control',	 
	'placeholder' => 'Password',	
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>

<div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open($this->uri->uri_string()); ?>
                            <fieldset>
                                <div class="form-group">
                                	<?php echo form_label($login_label, $login['id']); ?>
                                    <?php echo form_input($login); ?>
                                    <div class="alert-danger"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
                                </div>
                                <div class="form-group">
                                	<?php echo form_label('Password', $password['id']); ?>
                                    <?php echo form_password($password); ?>
                                    <div class="alert-danger"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php echo form_checkbox($remember); ?>
										<?php echo form_label('Remember me', $remember['id']); ?>
                                    </label>
                                </div>
                                <?php echo form_submit('submit', 'Login','class="btn btn-lg btn-success btn-block"'); ?>
                            </fieldset>
                        <?php echo form_close(); ?>
						<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
						                        
                    </div>
                </div>
            </div>
        </div>
</div>
   

 
