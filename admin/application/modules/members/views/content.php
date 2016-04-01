<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				Members
			</h1>
		</div>
	</div>
	<div class="row">
		<?php
			$attributes = array('id' => 'members-form');
			echo form_open('/',$attributes);
		?>
		<script>
		function submitForm(url){
			$('#members-form').attr('action', url);
			$("#members-form").submit();
		}
		</script>
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<?php if(validation_errors()!=''){?>
					<div class="alert alert-danger" role="alert">
						<?php echo validation_errors(); ?>
					</div>
					<?php } ?>
					<div class="toolbar-export">
						<div class="input-group">
						 	<select  name="export" class="form-control" >
								<option value="all">All</option>
								<option value="tagged">Tagged</option>
							</select>
					      	<span class="input-group-btn">
					        	<button class="btn btn-default" onClick="submitForm('<?php echo base_url('members/export');?>')" type="submit">Export</button>
					      </span>
					    </div>
					</div>
					<div class="toolbar-localization">
						<div class="btn-group" role="group" aria-label="Default button group">
					      <button onClick="submitForm('<?php echo base_url('members/setLocalization/all');?>')" type="submit" class="btn btn-default <?php if($this->session->userdata('localization')=='all'||$this->session->userdata('localization')=='' ){echo 'active';}?>">All</button>
					      <button onClick="submitForm('<?php echo base_url('members/setLocalization/uk');?>')" type="submit" class="btn btn-default <?php if($this->session->userdata('localization')=='uk'){echo 'active';}?>">UK</button>
					      <button onClick="submitForm('<?php echo base_url('members/setLocalization/foreign');?>')" type="submit" class="btn btn-default <?php if($this->session->userdata('localization')=='foreign'){echo 'active';}?>">Foreign</button>
					    </div>
					</div>
					<div class="toolbar-search">
					    <div class="input-group">
					      <input type="text" name="search" onkeyup="if (event.keyCode == 13) submitForm('<?php echo base_url('members/setSearch');?>');" value="<?php echo $this->session->userdata('member_search'); ?>" class="form-control" placeholder="Search...">
					      <span class="input-group-btn">
					        <button class="btn btn-default" onClick="submitForm('<?php echo base_url('members/setSearch');?>')" type="submit">Search</button>
					      </span>
					    </div>
					</div>
				</div>
				<div class="panel-heading clearfix">
					<div class="panel panel-default export-panel-1">
					  	<div class="panel-body">
							<label class="checkbox-inline" for="checkboxes-0">
						      	<input type="checkbox" name='all'> All
						    </label>
					  	</div>
					</div>
					<div class="panel panel-default export-panel-1">
					  	<div class="panel-body">
						    <label class="checkbox-inline" for="checkboxes-0">
						      	<input type="checkbox" name="tagged"> Tagged
						    </label>
					  	</div>
					</div>
					<div class="panel panel-default export-panel-2">
					  	<div class="panel-body">
						    <label class="checkbox-inline" >
						      	<input type="checkbox" name="49s"> ALL 49s
						    </label>
						    <label class="checkbox-inline">
						     	<input type="checkbox" name="ilb"> ALL ILB
						    </label>
						    <label class="checkbox-inline">
						      	<input type="checkbox" name="rapido"> ALL Rapido
						    </label>
						    <label class="checkbox-inline" >
						      	<input type="checkbox" name="vgr"> ALL VGR
						    </label>
						    <label class="checkbox-inline" >
						      	<input type="checkbox" name="vhr"> ALL  VHR
						    </label>
						</div>
					</div>
					<div class="panel panel-default export-panel-1">
					  	<div class="panel-body">
						    <label class="checkbox-inline" >
						      	<input type="checkbox" name="uk-email"> UK
						    </label>
						</div>
					</div>
					<div class="panel panel-default export-panel-1">
					  	<div class="panel-body">
						    <label class="checkbox-inline" >
						     	<input type="checkbox" name="foreign-email"> Foreign
						    </label>
						</div>
					</div>

					<div class="toolbar-email-button pull-right text-right">
						<button class="btn btn-success"  onClick="submitForm('<?php echo base_url('members/sendEmail');?>')" type="submit">Send Email</button>
					</div>
				</div>
				<div class="panel-body">

					<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
								<th><?php echo $registered_sort;?></th>
								<th><?php echo $first_name_sort;?></th>
								<th><?php echo $surname_sort;?></th>
								<th><?php echo $email_sort;?></th>
								<th><?php echo $address_sort;?></th>
								<th><?php echo $postcode_sort;?></th>
								<th><?php echo $country_sort;?></th>
								<th><?php echo $contest_sort;?></th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php if(!empty($members)):?>
                        <?php foreach($members as $member):?>
                            <tr>
                            	<td><input type="checkbox" name="selected[]" value="<?php echo $member->U_Id;?>"/></td>
								<td><?php echo ($member->U_RegistrationDate=='0000-00-00 00:00:00') ? '' : date("d/m/Y", strtotime($member->U_RegistrationDate));  ?></td>
								<td><?php echo $member->U_FirstName;?></td>
								<td><?php echo $member->U_Surname;?></td>
								<td><?php echo $member->U_Email;?></td>
								<td>
									  	<?php echo ($member->U_Address1!='') ? $member->U_Address1.'<br/>' : '';?>
									  	<?php echo ($member->U_Address2!='') ? $member->U_Address2.'<br/>' : '';?>
									  	<?php echo ($member->U_Town!='') ? $member->U_Town.'<br/>' : '';?>
									  	<?php echo ($member->U_County!='') ? $member->U_County.'<br/>' : '';?>

								</td>
								<td><?php echo $member->U_Postcode;?></td>
								<td><?php echo $member->U_Country;?></td>
								<td><?php echo ($member->U_Competitions=='1') ? 'YES' : 'NO';?></td>
								<td>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('/members/editMember/'.$member->U_Id);?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								</td>
								<td>
									<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/members/deleteMember/'.$member->U_Id);?>"><span class="fa fa-trash-o"></span> Delete</a>
								</td>
							</tr>
							<?php //echo $member->U_Age;?>
						  	<?php //echo ($member->U_Plays49s==1) ? '49s<br/>' : '';?>
						  	<?php //echo ($member->U_PlaysILB==1) ? 'ILB<br/>' : '';?>
						  	<?php //echo ($member->U_PlaysVHR==1) ? 'VHR<br/>' : '';?>
						  	<?php //echo ($member->U_PlaysVGR==1) ? 'VGR<br/>' : '';?>
						  	<?php //echo ($member->U_PlaysRapido==1) ? 'Rapido<br/>' : '';?>
						  	<?php //echo ($member->U_Age!='') ? 'Age: '.$member->U_Age.'<br/>' : '';?>
						  	<?php //if ($member->U_Gender==''){}
						  		//elseif($member->U_Gender=='F'){ //echo 'Gender: Female <br/>';}
						  		//elseif($member->U_Gender=='M'){ //echo 'Gender: Male <br/>';}  ?>
						  	<?php //echo ($member->U_SendPromotions==1) ? 'Send Promotions: YES<br/>' : 'Send Promotions: NO<br/>';?>
						  	<?php //echo ($member->U_IsSubscribed=='1') ? 'Is Subscribed: YES<br/>' : 'Is Subscribed: NO <br/>';?>
						<?php endforeach;?>
						<?php endif;?>
						</tbody>
					</table>

				</div>
				<div class="panel-footer clearfix">
					<?php echo $this->pagination->create_links();?>
					<div class="toolbar-search">
					   	<div class="pull-right">
			             	<p>Total results: <?php echo $total_results;?></p>
			        	</div>
					</div>
					<div class="toolbar-delimiter">

					    <div class="input-group">
						 	<select  name="delimiter" class="form-control" onchange="submitForm('<?php echo base_url('members/setDelimiter');?>')">
								<option value="50" <?php if($this->session->userdata('member_delimiter')=='50'){echo 'selected';} ?>>50</option>
								<option value="100" <?php if($this->session->userdata('member_delimiter')=='100'){echo 'selected';} ?>>100</option>
								<option value="200" <?php if($this->session->userdata('member_delimiter')=='200'){echo 'selected';} ?>>200</option>
								<option value="500" <?php if($this->session->userdata('member_delimiter')=='500'){echo 'selected';} ?>>500</option>
								<option value="1000" <?php if($this->session->userdata('member_delimiter')=='1000'){echo 'selected';} ?>>1000</option>
							</select>
					    </div>

					</div>
			    </div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
