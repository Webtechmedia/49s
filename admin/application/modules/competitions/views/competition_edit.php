<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header">Edit Competition</h1>
		</div>
	</div>
    <div class="row">
        <?php echo form_open('competitions/saveEditCompetition'); ?>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title"> <?php echo form_submit('save', 'Save Changes','class="btn btn-success pull-right "'); ?></h3>
                        <a href="<?php echo base_url('competitions')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
                    </div>
                    <div class="panel-body">
                       	<fieldset>
                       		<div class="form-group">
                        		<input type="hidden" name="id" value="<?php if(set_value('id')!=''){echo set_value('id');}else{ echo $competition[0]->id;} ?>"/>
                        		<div class="alert-danger"><?php echo form_error('id'); ?></div>
							</div>
							<div class="form-group">
								<?php echo form_label('Title'); ?>
								<input type="text" name="title" value="<?php if(set_value('title')!=''){echo set_value('title');}else{ echo $competition[0]->title;} ?>"  maxlength="80" size="30" class="form-control" placeholder="Competition title" autofocus="autofocus">
								<div class="alert-danger"><?php echo form_error('title'); ?></div>
							</div>
							<div class="form-group">
								<script>
									$(document).ready(function() {
										setup();
									});
								</script>
								<?php echo form_label('Content'); ?>
								<textarea class="form-control" id="content" name="content" rows="20"><?php if(set_value('content')!=''){echo set_value('content');}else{ echo $competition[0]->content;} ?></textarea>
								<div class="alert-danger"><?php echo form_error('content'); ?></div>
							</div>










							<div class="row">
								<div class="col-xs-6">
									<div class="panel panel-default">
			                        	<div class="panel-heading">Competition settings</div>
										<div class="panel-body">
											<div class="form-group">
												<?php echo form_label('Localization'); ?>
												<select name="localization" class="form-control">
													<option value="0" <?php if(set_value('localization')=='0'){echo 'selected';}elseif ($competition[0]->localization=='0'){echo 'selected';} ?>>UK only</option>
													<option value="1" <?php if(set_value('localization')=='1'){echo 'selected';}elseif ($competition[0]->localization=='1'){echo 'selected';} ?>>Foreign only</option>
													<option value="2" <?php if(set_value('localization')=='2'){echo 'selected';}elseif ($competition[0]->localization=='2'){echo 'selected';} ?>>All locations</option>
												</select>
												<div class="alert-danger"><?php echo form_error('localization'); ?></div>
											</div>
											<div class="form-group">
												<?php echo form_label('Date From'); ?>
												<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $competition[0]->date_from);?>
												<div class='input-group' >
													<input type="text" name="date_from" id='date_from' value="<?php if(set_value('date_from')!=''){echo set_value('date_from');}else{ echo $date->format('d-m-Y H:i a');} ?>"  maxlength="80" size="30" class="form-control" placeholder="Date From" >
													<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>
												<div class="alert-danger"><?php echo form_error('date_from'); ?></div>
											</div>
											<script type="text/javascript">
										        $(function () {
										            $('#date_from').datetimepicker({
										               format: 'DD-MM-YYYY h:mm a'
										            });
										        });
											</script>
											<div class="form-group">
				                            	<?php echo form_label('Date To'); ?>
				                            	<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $competition[0]->date_to);?>
				                            	<div class='input-group' >
				                                    <input type="text" name="date_to" id="date_to" value="<?php if(set_value('date_to')!=''){echo set_value('date_to');}else{ echo $date->format('d-m-Y H:i a');} ?>"  maxlength="80" size="30" class="form-control" placeholder="Date To" >
				                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				                                </div>
				                                <div class="alert-danger"><?php echo form_error('date_to'); ?></div>
											</div>
				                            <script type="text/javascript">
										        $(function () {
										            $('#date_to').datetimepicker({
										               format: 'DD-MM-YYYY h:mm a'
										            });
										        });
										    </script>
											<div class="form-group">
				                            	<?php echo form_label('Draw Date'); ?>
				                            	<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $competition[0]->draw_date);?>
				                            	<div class='input-group' >
				                                    <input type="text" name="draw_date" id="draw_date" value="<?php if(set_value('draw_date')!=''){echo set_value('draw_date');}else{ echo $date->format('d-m-Y H:i a');} ?>"  maxlength="80" size="30" class="form-control" placeholder="Draw Date" >
				                           			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				                           		</div>
				                     			<div class="alert-danger"><?php echo form_error('draw_date'); ?></div>
				               				</div>
				                            <script type="text/javascript">
										        $(function () {
										            $('#draw_date').datetimepicker({
										               format: 'DD-MM-YYYY h:mm a'
										            });
										        });
										    </script>
			                               	<div class="form-group">
			                                	<?php echo form_label('Status'); ?>
			                                	<select name="status" class="form-control">
													<option value="0" <?php if(set_value('status')=='0'){echo 'selected';}elseif ($competition[0]->status=='0'){echo 'selected';} ?>>Inactive</option>
													<option value="1" <?php if(set_value('status')=='1'){echo 'selected';}elseif ($competition[0]->status=='1'){echo 'selected';} ?>>Active</option>
												</select>
			                                    <div class="alert-danger"><?php echo form_error('status'); ?></div>
			                                </div>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="panel panel-default">
			                        	<div class="panel-heading">Optional</div>
										<div class="panel-body">
			          						<div class="form-group">
			                                	<?php echo form_label('First Prize Description'); ?>
			                                    <input type="text" name="first_prize" value="<?php if(set_value('first_prize')!=''){echo set_value('first_prize');}else{ echo $competition[0]->first_prize;} ?>"  maxlength="80" size="30" class="form-control" placeholder="First Prize">
			                                    <div class="alert-danger"><?php echo form_error('first_prize'); ?></div>
			                                </div>
			                                <div class="form-group">
			                                	<?php echo form_label('First Prize Quantity'); ?>
			                                    <input type="number" name="first_prize_qty" value="<?php if(set_value('first_prize_qty')!=''){echo set_value('first_prize_qty');}else{ echo $competition[0]->first_prize_qty;} ?>"  maxlength="80" size="30" class="form-control" placeholder="0">
			                                    <div class="alert-danger"><?php echo form_error('first_prize_qty'); ?></div>
			                                </div>
			                                <div class="form-group">
			                                	<?php echo form_label('Second Prize Description'); ?>
			                                    <input type="text" name="second_prize" value="<?php if(set_value('second_prize')!=''){echo set_value('second_prize');}else{ echo $competition[0]->second_prize;} ?>"  maxlength="80" size="30" class="form-control" placeholder="Second Prize">
			                                    <div class="alert-danger"><?php echo form_error('second_prize'); ?></div>
			                                </div>
			                                <div class="form-group">
			                                	<?php echo form_label('Second Prize Quantity'); ?>
			                                    <input type="number" name="second_prize_qty"  value="<?php if(set_value('second_prize_qty')!=''){echo set_value('second_prize_qty');}else{ echo $competition[0]->second_prize_qty;} ?>" maxlength="80" size="30" class="form-control" placeholder="0">
			                                    <div class="alert-danger"><?php echo form_error('second_prize_qty'); ?></div>
			                                </div>
			                                <div class="form-group">
			                                	<?php echo form_label('Third Prize Description'); ?>
			                                    <input type="text" name="third_prize" value="<?php if(set_value('third_prize')!=''){echo set_value('third_prize');}else{ echo $competition[0]->third_prize;} ?>"  maxlength="80" size="30" class="form-control" placeholder="Third Prize" >
			                                    <div class="alert-danger"><?php echo form_error('third_prize'); ?></div>
			                                </div>
			                                <div class="form-group">
			                                	<?php echo form_label('Third Prize Quantity'); ?>
			                                    <input type="number" name="third_prize_qty"  value="<?php if(set_value('third_prize_qty')!=''){echo set_value('third_prize_qty');}else{ echo $competition[0]->third_prize_qty;} ?>" maxlength="80" size="30" class="form-control" placeholder="0">
			                                    <div class="alert-danger"><?php echo form_error('third_prize_qty'); ?></div>
			                                </div>
										</div>
									</div>
								</div>
							</div>

						</fieldset>
                    </div>
                </div>
            </div>
         <?php echo form_close(); ?>
	</div>
</div>







