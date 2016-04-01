<?php
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
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
?>

<div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Forgot password</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open($this->uri->uri_string()); ?>
                            <fieldset>
                                <div class="form-group">
                                	<?php echo form_label($login_label, $login['id']); ?>
                                    <?php echo form_input($login); ?>
                                    <div class="alert-danger"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
                                </div>
                              
                             
                                <?php echo form_submit('reset', 'Get a new password','class="btn btn-lg btn-success btn-block"'); ?>
                                
                            </fieldset>
                        <?php echo form_close(); ?>
				                        
                    </div>
                </div>
            </div>
        </div>
</div>
   


 

 