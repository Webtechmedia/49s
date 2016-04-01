<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' =>'form-control',
	'placeholder' => 'New password',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'class' =>'form-control',
	'placeholder' => 'Confirm new password',
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
                                	<?php echo form_label('New Password', $new_password['id']); ?>
                                    <?php echo form_password($new_password); ?>
                                    <div class="alert-danger"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></div>
                                </div>
                                <div class="form-group">
                                	<?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?>
                                    <?php echo form_password($confirm_new_password); ?>
                                    <div class="alert-danger"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></div>
                                </div>
                                
                                <?php echo form_submit('change', 'Change Password','class="btn btn-lg btn-success btn-block"'); ?>
                            </fieldset>
                        <?php echo form_close(); ?>                 
                    </div>
                </div>
            </div>
        </div>
</div>
   

 
 
 