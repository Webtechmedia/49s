<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'class' =>'form-control',
	'placeholder' => 'Old Password',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' =>'form-control',
	'placeholder' => 'New Password',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'class' =>'form-control',
	'placeholder' => 'Confirm New Password',
);
?>







<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header">Change Password</h1>
		</div>
	</div>
    <div class="row">
    	<?php echo form_open($this->uri->uri_string()); ?>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <?php echo form_submit('change', 'Change Password','class="btn btn-md btn-success pull-right"'); ?>
                    </div>
                    <div class="panel-body">

                            <fieldset>
                                <div class="form-group">
                                	<?php echo form_label('Old Password', $old_password['id']); ?>
                                    <?php echo form_password($old_password); ?>
                                    <div class="alert-danger"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></div>
                                </div>
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


                            </fieldset>

                    </div>
                </div>
            </div>
    	<?php echo form_close(); ?>
    </div>
</div>


