<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header"><?php echo $title;?></h1>
		</div>
	</div>
    <div class="row">

            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title"> <?php echo form_submit('add', 'Save New Winner','class="btn btn-success pull-right " form="mainform"'); ?></h3>
                        <a href="<?php echo base_url('winners')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
                    </div>
                    <div class="panel-body">
                       	<fieldset>



						<form action="<?php echo base_url('ajaxupload/index');?> " method="post" enctype="multipart/form-data" id="MyUploadForm">
 							<div class="col-md-3 pull-right" style="margin-right:450px;">
 							<br/><br/><br/><br/><br/>
			    				<div class="input-group">
									<span class="btn btn-default btn-file">
										Browse <input  name="image_file" id="imageInput" type="file" />
									</span>
								    <span class="input-group-btn" style="width:150px">
						     	 		<input type="submit"  id="submit-btn" value="Upload" class="btn btn-primary"/>
									</span>
							    </div>
						  	</div>
							<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading-img" style="display:none;" alt="Please Wait"/>
						</form>





						<?php echo form_open('winners/insertNewWinner',array('id'=>'mainform','form'=>'mainform','name'=>'mainform'));?>

							<div class="row form-group">
								<div class="col-md-3">
								<?php echo form_label('Upload Image ( 212 x 212 )'); ?>
									<div id="output">
										<input type="hidden" name="image_path" value="<?php if(set_value('image_path')!=''){echo set_value('image_path');}else{ echo 'admin/images/no_image_available.jpg'; } ?>"/>
										<input type="hidden" name="admin_image_path" value="<?php if(set_value('admin_image_path')!=''){echo set_value('admin_image_path');}else{ echo base_url('images/no_image_available.jpg'); } ?>"/>
										<img src="<?php if(set_value('admin_image_path')!=''){echo set_value('admin_image_path');}else{ echo base_url('images/no_image_available.jpg'); } ?>" class="img-thumbnail" />
									</div>
								</div>
								<div class="alert-danger"><?php echo form_error('admin_image_path'); ?></div>
                                <div class="alert-danger"><?php echo form_error('image_path'); ?></div>
							</div>




							<div class="form-group">
								<?php echo form_label('Title'); ?>
								<input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" class="form-control" placeholder="Competition title" >
								<div class="alert-danger"><?php echo form_error('title'); ?></div>
							</div>
							<div class="form-group">
								<script>
									$(document).ready(function() {
										setup();
									});
								</script>
								<?php echo form_label('Content'); ?>
								<textarea class="form-control" id="content" name="content" rows="20"><?php echo set_value('content'); ?></textarea>
								<div class="alert-danger"><?php echo form_error('content'); ?></div>
							</div>
							<div class="form-group">
								<?php echo form_label('Game'); ?>
								<select name="game" class="form-control">
									<option value="is_49s" <?php if(set_value('game')=='is_49s'){echo 'selected';} ?>>49s</option>
									<option value="is_ilb" <?php if(set_value('game')=='is_ilb'){echo 'selected';} ?>>Irish Lotto</option>
									<option value="is_ra" <?php if(set_value('game')=='is_ra'){echo 'selected';} ?>>Rapido</option>
									<option value="is_vgr" <?php if(set_value('game')=='is_vgr'){echo 'selected';} ?>>Virtual Greyhound Racing</option>
									<option value="is_vhr" <?php if(set_value('game')=='is_vhr'){echo 'selected';} ?>>Virtual Horse Racing</option>
								</select>
								<div class="alert-danger"><?php echo form_error('game'); ?></div>
							</div>


						<?php echo form_close(); ?>
						</fieldset>
                    </div>
                </div>
            </div>

	</div>
</div>







