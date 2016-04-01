<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header">View Competition Details</h1>
		</div>
	</div>
	<div class="row">
    	<div class="col-xs-12">
           <div class="panel panel-default">
                <div class="panel-heading clearfix">
					<a href="<?php echo base_url('competitions')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Back</a>
                </div>
				<div class="panel-body">
                    <div class="row">
	                    <div class="col-xs-4">
	                    	<div class="panel panel-default">
	                        	<div class="panel-heading">Competition Details</div>
								<div class="panel-body">
									<div class="form-group">
	                                	<strong>Title:</strong> <?php echo $competition[0]->title;?>
	                                </div>

	                                <div class="form-group">
	                        			<strong>Localization:</strong> <?php if($competition[0]->localization=='0'){ echo 'UK only'; }elseif($competition[0]->localization=='1'){echo 'Foreign only';}elseif($competition[0]->localization=='all'){echo 'All localizations';};?>
	                                </div>
	                                <div class="form-group">
	                                	<strong>Date From:</strong> <?php echo $competition[0]->date_from;?>
	                                </div>
	                                <div class="form-group">
	                                	<strong>Date To:</strong> <?php echo $competition[0]->date_to;?>
	                                </div>
	                                <div class="form-group">
	                                	<strong>Draw Date:</strong> <?php echo $competition[0]->draw_date;?>
	                                </div>
	                                <div class="form-group">
	                                	<strong>Created:</strong> <?php echo $competition[0]->create_date;?>
	                                </div>
	                               <div class="form-group">
	                               		<strong>Status:</strong> <?php if($competition[0]->status=='0'){echo 'Inactive';}else{echo 'Active';} ;?>
	                                </div>
								</div>
							</div>
						</div>
						<div class="col-xs-8">
							<div class="panel panel-default">
	                        	<div class="panel-heading">Content</div>
								<div class="panel-body">
	                                 <?php echo $competition[0]->content;?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="panel panel-default">
							<div class="panel-heading">Winners</div>
							  <div class="panel-body">
		                        <div class="form-group">
                                	<strong>First Prize:</strong> <?php echo $competition[0]->first_prize;?>
                                </div>
                                <div class="form-group">
                                	<strong>First Prize Qty.:</strong> <?php echo $competition[0]->first_prize_qty;?>
                                </div>
                                <div class="form-group">
                                	<strong>First Prize Winners:</strong>
                                	<?php $first_winners=json_decode($competition[0]->first_prize_winners);
										if($first_winners!=null){
											echo '<ul class="list-group">';
											foreach($first_winners as $winner){
												echo '<li class="list-group-item clearfix">'.$winner->id.' - '.$winner->name.' '.$winner->surname.' - '.$winner->email.'<a class="btn btn-danger btn-xs pull-right" href="'.base_url('competitions/removeFirstPrizeWinner').'/'.$competition[0]->id.'/'.$winner->id.'/'.$this->uri->segment(4).'" onclick="return confirm(\'This user will be removed from winners!\') ? true : false;"><span class="fa fa-trash-o"></span> Remove</a></li>';
											}
											echo '</ul>';
										}
                                	?>
                                </div>
                                <div class="form-group">
                                	<strong>Second Prize:</strong> <?php echo $competition[0]->second_prize;?>
                                </div>
                                <div class="form-group">
                                	<strong>Second Prize Qty.:</strong> <?php echo $competition[0]->second_prize_qty;?>
                                </div>
                                <div class="form-group">
                                	<strong>Second Prize Winners:</strong>
                                	 <?php $second_winners=json_decode($competition[0]->second_prize_winners);
										if($second_winners!=null){
											echo '<ul class="list-group">';
											foreach($second_winners as $winner){
												echo '<li class="list-group-item clearfix">'.$winner->id.' - '.$winner->name.' '.$winner->surname.' - '.$winner->email.'<a class="btn btn-danger btn-xs pull-right" href="'.base_url('competitions/removeSecondPrizeWinner').'/'.$competition[0]->id.'/'.$winner->id.'/'.$this->uri->segment(4).'" onclick="return confirm(\'This user will be removed from winners!\') ? true : false;"><span class="fa fa-trash-o"></span> Remove</a></li>';
											}
											echo '</ul>';
										}
                                	?>
                                </div>
                                <div class="form-group">
                                	<strong>Third Prize:</strong> <?php echo $competition[0]->third_prize;?>
                                </div>
                                <div class="form-group">
                                	<strong>Third Prize Qty.:</strong> <?php echo $competition[0]->third_prize_qty;?>
                                </div>
                                <div class="form-group">
                                	<strong>Third Prize Winners:</strong>
                                	<?php $third_winners=json_decode($competition[0]->third_prize_winners);
										if($third_winners!=null){
											echo '<ul class="list-group">';
											foreach($third_winners as $winner){
												echo '<li class="list-group-item clearfix">'.$winner->id.' - '.$winner->name.' '.$winner->surname.' - '.$winner->email.'<a class="btn btn-danger btn-xs pull-right" href="'.base_url('competitions/removeThirdPrizeWinner').'/'.$competition[0]->id.'/'.$winner->id.'/'.$this->uri->segment(4).'" onclick="return confirm(\'This user will be removed from winners!\') ? true : false;"><span class="fa fa-trash-o"></span> Remove</a></li>';
											}
											echo '</ul>';
										}
                                	?>
                                </div>
							  </div>
							</div>
						</div>
					</div>


					<div class="panel panel-default">
						<div class="panel-heading clearfix">


							<div class="panel-heading contestants-title ">Contestants</div>



			            	<div class="toolbar-add-to-competition">
								<?php
				                $attributes = array('id' => 'add-to-competition');
				                echo form_open('competitions/addUserToCompetition/'.$competition[0]->id,$attributes);
				                ?>
								<div class="input-group">

									<input type="text" name="add_competition_user" onkeyup="if (event.keyCode == 13) $('#add-to-competition').submit();" value="" class="form-control" placeholder="Email...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">Add User</button>
									</span>
								</div>
								<div class="alert-danger"><?php echo form_error('add_competition_user'); ?></div>
								<?php echo form_close();?>
							</div>






				            	<div class="toolbar-add-to-competition pull-right">
				            	<?php echo form_open('competitions/setCompetitionSearch/'.$competition[0]->id); ?>
									<div class="input-group">
										<input type="text" name="competition_email" onkeyup="if (event.keyCode == 13) $('form').submit();" value="<?php echo $this->session->userdata('competition_search_email'); ?>" class="form-control" placeholder="Email...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"> Search</button>
										</span>
									</div>
								<?php echo form_close();?>
								</div>






						</div>
					  	<div class="panel-body">
		       				<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Address</th>
										<th>1st prize winner</th>
										<th>2nd prize winner</th>
										<th>3rd prize winner</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php if($users){?>
								<?php foreach($users as $user){?>
									<tr>
										<td><?php echo $user->U_Id; ?></td>
										<td><?php echo $user->U_FirstName; ?></td>
										<td><?php echo $user->U_Surname; ?></td>
										<td><?php echo $user->U_Email; ?></td>
										<td>
											<?php if($user->U_Address1!=''){echo $user->U_Address1.'<br/>';} ?>
											<?php if($user->U_Address2!=''){echo $user->U_Address2.'<br/>';} ?>
											<?php if($user->U_Town!=''){echo $user->U_Town.'<br/>';} ?>
											<?php if($user->U_County!=''){echo $user->U_County.'<br/>';} ?>
											<?php if($user->U_Country!=''){echo $user->U_Country.'<br/>';} ?>
										</td>
										<td><a class="btn btn-success btn-xs" href="<?php echo base_url('competitions/addFirstPrizeUserToCompetition/'.$competition[0]->id.'/'.$user->U_Id.'/'.$this->uri->segment(4)) ?>" role="button"><span class="fa fa-add"></span> Add</a></td>
										<td><a class="btn btn-success btn-xs" href="<?php echo base_url('competitions/addSecondPrizeUserToCompetition/'.$competition[0]->id.'/'.$user->U_Id.'/'.$this->uri->segment(4)) ?>" role="button"><span class="fa fa-add"></span> Add</a></td>
										<td><a class="btn btn-success btn-xs" href="<?php echo base_url('competitions/addThirdPrizeUserToCompetition/'.$competition[0]->id.'/'.$user->U_Id.'/'.$this->uri->segment(4)) ?>" role="button"><span class="fa fa-add"></span> Add</a></td>
										<td>
											<a class="btn btn-danger btn-xs" href="<?php echo base_url('competitions/removeUserFromCompetition/'.$competition[0]->id.'/'.$user->U_Id.'/'.$this->uri->segment(4)) ?>" onclick="return confirm('This user will be removed from competition!') ? true : false;"><span class="fa fa-trash-o"></span> Remove</a>
										</td>
									</tr>
								<?php } ?>
								<?php } ?>
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
								  <select  name="competition_delimiter" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
										<option value="<?php echo base_url('competitions/setDelimiter').'/'.$competition[0]->id.'/'?>50" <?php if($this->session->userdata('competition_delimiter')=='50'){echo 'selected';} ?>>50</option>
										<option value="<?php echo base_url('competitions/setDelimiter').'/'.$competition[0]->id.'/'?>100" <?php if($this->session->userdata('competition_delimiter')=='100'){echo 'selected';} ?>>100</option>
										<option value="<?php echo base_url('competitions/setDelimiter').'/'.$competition[0]->id.'/'?>200" <?php if($this->session->userdata('competition_delimiter')=='200'){echo 'selected';} ?>>200</option>
										<option value="<?php echo base_url('competitions/setDelimiter').'/'.$competition[0]->id.'/'?>500" <?php if($this->session->userdata('competition_delimiter')=='500'){echo 'selected';} ?>>500</option>
										<option value="<?php echo base_url('competitions/setDelimiter').'/'.$competition[0]->id.'/'?>1000" <?php if($this->session->userdata('competition_delimiter')=='1000'){echo 'selected';} ?>>1000</option>
									</select>
							    </div>
							</div>
					    </div>
					</div>
            	</div>
        	</div>
    	</div>
	</div>
</div>