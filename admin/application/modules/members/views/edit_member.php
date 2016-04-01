<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				<?php echo $title;?>
			</h1>
		</div>
	</div>
	<div class="row">
		<?php echo form_open('/members/updateMember/'.$member[0]->U_Id);?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<input type="submit" name="add" value="Save Changes" class="btn btn-success pull-right " >
					<a href="<?php echo base_url('members/index');?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
				</div>
				<div class="panel-body" >
					<?php echo form_label('Member Plays'); ?>
					<div class="row">
					    <div class="col-md-15 ">
				        	<div class="panel">
				        		<div class="panel-heading clearfix">
						    		<label for="49s"><img src="<?php echo base_url("images/logo_49s.png") ?>" style="width:64px;"></label>
						    	</div>
				            	<div class="panel-body">

									<input type="checkbox" name="49s" id="49s" value="TRUE" <?php if($member[0]->U_Plays49s=='1'){echo 'checked';} ?><?php echo set_checkbox('49s', 'TRUE'); ?>>
									<label for="49s">49's</label>
				         		</div>
				     		</div>
					    </div>
					    <div class="col-md-15 ">
				        	<div class="panel">
								<div class="panel-heading clearfix">
						    	 	<label for="irish"><img src="<?php echo base_url("images/logo_irish_lotto_bet.png") ?>" style="width:70px;"></label>
						    	</div>
				            	<div class="panel-body">
									<input type="checkbox" name="irish" id="irish" value="TRUE" <?php if($member[0]->U_PlaysILB=='1'){echo 'checked';} ?><?php echo set_checkbox('irish', 'TRUE'); ?> >
									<label for="irish">Irish Lotto Bet</label>
				         		</div>
				     		</div>
					    </div>
					    <div class="col-md-15 ">
				        	<div class="panel">
						    	<div class="panel-heading clearfix">
							    	<label for="vhr"><img src="<?php echo base_url("images/logo_vhr.png") ?>" style="width:68px;"></label>
							    </div>
				            	<div class="panel-body">
									<input type="checkbox" name="vhr" id="vhr"  value="TRUE" <?php if($member[0]->U_PlaysVHR=='1'){echo 'checked';} ?><?php echo set_checkbox('vhr', 'TRUE'); ?>>
									<label for="vhr">Virtual Horse Racing</label>
				         		</div>
				     		</div>
					    </div>
					    <div class="col-md-15 ">
				        	<div class="panel">
						    	<div class="panel-heading clearfix">
							    	 <label for="vgr"><img src="<?php echo base_url("images/logo_vgr.png") ?>" style="width:68px;"></label>
							    </div>
				            	<div class="panel-body">
									<input type="checkbox" name="vgr" id="vgr"  value="TRUE" <?php if($member[0]->U_PlaysVGR=='1'){echo 'checked';} ?><?php echo set_checkbox('vgr', 'TRUE'); ?>>
									<label for="vgr">Virtual Greyhound Racing</label>
				         		</div>
				     		</div>
					    </div>
					    <div class="col-md-15 ">
				        	<div class="panel">
						    	<div class="panel-heading clearfix">
							    	<label for="rapido"><img src="<?php echo base_url("images/logo_rapido.png") ?>" style="width:50px;" ></label>
							    </div>
				            	<div class="panel-body">
									<input type="checkbox" name="rapido" id="rapido"  value="TRUE" <?php if($member[0]->U_PlaysRapido=='1'){echo 'checked';} ?><?php echo set_checkbox('rapido', 'TRUE'); ?>>
									<label for="rapido">Rapido</label>
				         		</div>
				     		</div>
					    </div>

					</div>
					<div class="alert-danger"><?php echo form_error('49s'); ?></div>










					<div class="col-xs-6">
						<div class="panel panel-default">
                        	<div class="panel-heading">Member Data</div>
							<div class="panel-body">
								<div class="form-group">
									<?php echo form_label('First Name'); ?>
									<input type="text" name="first_name" id="first_name" value="<?php if(set_value('first_name')!=''){echo set_value('first_name');}else{echo $member[0]->U_FirstName; }  ?>" class="form-control" placeholder="First Name" >
									<div class="alert-danger"><?php echo form_error('first_name'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Surname'); ?>
									<input type="text" name="surname" id="surname" value="<?php if(set_value('surname')!=''){echo set_value('surname');}else{echo $member[0]->U_Surname; }  ?>" class="form-control" placeholder="Surname" >
									<div class="alert-danger"><?php echo form_error('surname'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Email'); ?>
									<input type="text" name="email" id="email" value="<?php if(set_value('email')!=''){echo set_value('email');}else{echo $member[0]->U_Email; }  ?>" class="form-control" placeholder="Email" >
									<div class="alert-danger"><?php echo form_error('email'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Age'); ?>
									<input type="number" name="age" id="age" value="<?php if(set_value('age')!=''){echo set_value('age');}else{echo $member[0]->U_Age; }  ?>" class="form-control" placeholder="Age" >
									<div class="alert-danger"><?php echo form_error('age'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Gender'); ?>
									<select id="gender" name="gender" class="form-control">
										<option value="M" <?php if($member[0]->U_Gender=='M'){echo 'selected="selected"'; }?><?php echo set_select('gender', 'M'); ?>>Male</option>
										<option value="F" <?php if($member[0]->U_Gender=='F'){echo 'selected="selected"'; }?><?php echo set_select('gender', 'F'); ?>>Female</option>
									</select>
									<div class="alert-danger"><?php echo form_error('gender'); ?></div>
								</div>

								<div class="form-group"><?php echo set_select('send_promotions'); ?>
									<?php echo form_label('Send Promotions'); ?>
									<select id="send_promotions" name="send_promotions" class="form-control">
										<option value="1" <?php if($member[0]->U_SendPromotions=='1' && set_select('send_promotions', '0')=='' && set_select('send_promotions', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('send_promotions', '1'); ?>>Yes</option>
										<option value="0" <?php if($member[0]->U_SendPromotions=='0' && set_select('send_promotions', '0')=='' && set_select('send_promotions', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('send_promotions', '0'); ?>>No</option>
									</select>
									<div class="alert-danger"><?php echo form_error('send_promotions'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Competitions'); ?>
									<select id="competitions" name="competitions" class="form-control">
										<option value="1" <?php if($member[0]->U_Competitions=='1' && set_select('competitions', '0')=='' && set_select('competitions', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('competitions', '1'); ?>>Yes</option>
										<option value="0" <?php if($member[0]->U_Competitions=='0' && set_select('competitions', '0')=='' && set_select('competitions', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('competitions', '0'); ?>>No</option>
									</select>
									<div class="alert-danger"><?php echo form_error('competitions'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Is Subscribed'); ?>
									<select id="is_subscribed" name="is_subscribed" class="form-control">
										<option value="1" <?php if($member[0]->U_IsSubscribed=='1' && set_select('is_subscribed', '0')=='' && set_select('is_subscribed', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('is_subscribed', '1'); ?>>Yes</option>
										<option value="0" <?php if($member[0]->U_IsSubscribed=='0' && set_select('is_subscribed', '0')=='' && set_select('is_subscribed', '1')=='' ){echo 'selected="selected"'; }?><?php echo set_select('is_subscribed', '0'); ?>>No</option>
									</select>
									<div class="alert-danger"><?php echo form_error('is_subscribed'); ?></div>
								</div>







							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="panel panel-default">
                        	<div class="panel-heading">Address</div>
							<div class="panel-body">

								<div class="form-group">
									<?php echo form_label('Address Line 1'); ?>
									<input type="text" name="address1" id="address1" value="<?php if(set_value('address1')!=''){echo set_value('address1');}else{echo $member[0]->U_Address1; }  ?>" class="form-control" placeholder="Address 1" >
									<div class="alert-danger"><?php echo form_error('address1'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Address Line 2'); ?>
									<input type="text" name="address2" id="address2" value="<?php if(set_value('address2')!=''){echo set_value('address2');}else{echo $member[0]->U_Address2; }  ?>" class="form-control" placeholder="Address 2" >
									<div class="alert-danger"><?php echo form_error('address2'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Town'); ?>
									<input type="text" name="town" id="town" value="<?php if(set_value('town')!=''){echo set_value('town');}else{echo $member[0]->U_Town; }  ?>" class="form-control" placeholder="Town" >
									<div class="alert-danger"><?php echo form_error('town'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('County'); ?>
									<input type="text" name="county" id="county" value="<?php if(set_value('county')!=''){echo set_value('county');}else{echo $member[0]->U_County; }  ?>" class="form-control" placeholder="County" >
									<div class="alert-danger"><?php echo form_error('county'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Country'); ?>
									<input type="text" name="country" id="country" value="<?php if(set_value('country')!=''){echo set_value('country');}else{echo $member[0]->U_Country; }  ?>" class="form-control" placeholder="Country" >
									<div class="alert-danger"><?php echo form_error('country'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_label('Postcode'); ?>
									<input type="text" name="postcode" id="postcode" value="<?php if(set_value('postcode')!=''){echo set_value('postcode');}else{echo $member[0]->U_Postcode; }  ?>" class="form-control" placeholder="Postcode" >
									<div class="alert-danger"><?php echo form_error('postcode'); ?></div>
								</div>





							</div>
						</div>
					</div>


























				</div>
				<div class="panel-footer clearfix">
			    </div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>


