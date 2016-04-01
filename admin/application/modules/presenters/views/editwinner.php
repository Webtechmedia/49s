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
                        <h3 class="panel-title"> <?php echo form_submit('add', 'Save Changes','class="btn btn-success pull-right " form="mainform"'); ?></h3>
                        <a href="<?php echo base_url('presenters')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
                    </div>
                    <div class="panel-body">
                       	<fieldset>



							<?php echo form_open('presenters/updatepresenter/'.$winner->id,array('id'=>'mainform','form'=>'mainform','name'=>'mainform'));?>


							<div class="error" id="error_header_uploader" style="display:none;"></div>


							<div class="col-md-3 pull-right" style="margin-right:450px;">
								<br/><br/><br/><br/><br/>
								<div class="input-group">
								<span class="btn btn-default btn-file">
									Browse <input  name="image_file" id="imageInput" type="file" />
								</span>
								</div>
							</div>
							<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading-img" style="display:none;" alt="Please Wait"/>



							<div class="row form-group">
								<div class="col-md-3">
									<?php echo form_label('Upload Image ( 311 x 359 )'); ?>
									<div id="output">
										<img name="temp_img" id="temp_img" src="<?php echo ( ($winner->main_img != '') ? base_url($winner->main_img) : "") ?>" class="img-thumbnail" />
									</div>
								</div>
							</div>


							<div class="col-md-3 pull-right" style="margin-right:450px;">
								<br/><br/><br/><br/><br/>
								<div class="input-group">
								<span class="btn btn-default btn-file">
									Browse <input  name="image_file2" id="imageInput2" type="file" />
								</span>
								</div>
							</div>
							<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading-img" style="display:none;" alt="Please Wait"/>



							<div class="row form-group">
								<div class="col-md-3">
									<?php echo form_label('Upload Thumb ( 311 x 189 )'); ?>
									<div id="output">
										<img name="temp_img2" id="temp_img2" src="<?php echo ( ($winner->thumb_img != '') ? base_url($winner->thumb_img) : "") ?>" class="img-thumbnail" />
									</div>
								</div>
							</div>


							<div class="col-md-3 pull-right" style="margin-right:450px;">
								<br/><br/><br/><br/><br/>
								<div class="input-group">
								<span class="btn btn-default btn-file">
									Browse <input  name="video_file" id="videoInput" type="file" />
								</span>
								</div>
							</div>
							<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading-img" style="display:none;" alt="Please Wait"/>



							<div class="row form-group">
								<div class="col-md-3">
									<?php echo form_label('Upload Video ( 640 x 360 )'); ?>
									<video id="temp_video" width="320" height="240"  controls>
										<source id="video_src" src="<?php echo ( ($winner->main_video != '') ? base_url($winner->main_video) : "") ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>
								</div>
								<div class="alert-danger"><?php echo form_error('admin_image_path'); ?></div>
								<div class="alert-danger"><?php echo form_error('image_path'); ?></div>
							</div>



							<script>
								$(document).ready(function() {

									$("#imageInput").change(function(  ) {
										event.preventDefault();
										//alert( "Handler for .submit() called." );
										postImage();
									});

									$("#imageInput2").change(function(  ) {
										event.preventDefault();
										//alert( "Handler for .submit() called." );
										postImage2();
									});
									$("#videoInput").change(function(  ) {
										event.preventDefault();
										//alert( "Handler for .submit() called." );
										postVideo();
									});
								});
								function postImage(){
									$.ajax({
										url: "<?php echo base_url('/presenters/prepare_image')  ?>",
										type: "POST",
										data:  new FormData($("#mainform")[0]),
										contentType: false,
										cache: false,
										processData:false,
										success: function(data){
											//alert(data.server_obj.success);
											//data = jQuery.parseJSON( data );
											if(data.server_obj.success == true){
												//$("#error_header_uploader").hide();
												$("#temp_img").attr('src',data.body);
												//$("#update_submit").show();
											} else {
												$("#error_header_uploader").hide();
												$("#error_header_uploader").show();
												$("#error_header_uploader").html(data.server_obj.error_msg.error);
												//$("#update_submit").hide();
											}
										}
									});
								}
								function postImage2(){
									$.ajax({
										url: "<?php echo base_url('/presenters/prepare_image2')  ?>",
										type: "POST",
										data:  new FormData($("#mainform")[0]),
										contentType: false,
										cache: false,
										processData:false,
										success: function(data){
											//alert(data.server_obj.success);
											//data = jQuery.parseJSON( data );
											if(data.server_obj.success == true){
												//$("#error_header_uploader").hide();
												$("#temp_img2").attr('src',data.body);
												//$("#update_submit").show();
											} else {
												$("#error_header_uploader").hide();
												$("#error_header_uploader").show();
												$("#error_header_uploader").html(data.server_obj.error_msg.error);
												//$("#update_submit").hide();
											}
										}
									});
								}
								function postVideo(){
									$.ajax({
										url: "<?php echo base_url('/presenters/prepare_video') ?>",
										type: "POST",
										data:  new FormData($("#mainform")[0]),
										contentType: false,
										cache: false,
										processData:false,
										success: function(data){
											//alert(data.server_obj.success);
											//data = jQuery.parseJSON( data );
											if(data.server_obj.success == true){
												//$("#temp_image").attr('src',data.body);
												//$("#temp_video video source").attr('src', data.body);
												$('#video_src').attr('src', data.body);
												$('#temp_video').get(0).load();
												$("#temp_video").get(0).play();;

												$("#update_submit").show();
												$("#error_header_uploader").hide();
											} else {
												$("#error_header_uploader").hide();
												$("#error_header_uploader").show();
												$("#error_header_uploader").html(data.server_obj.error_msg.error);
												$("#update_submit").hide();
											}
										}
									});
								}
							</script>




							<label>Default</label>
							<input type="checkbox" value="1" name="default" <?php if(set_value('default')==1 || $winner->default==1 ){ echo 'checked'; } ?>>


							<div class="form-group">
								<?php echo form_label('Title'); ?>
								<input type="text" name="title" id="title" value="<?php if(set_value('title')!=''){echo set_value('title');}else{echo $winner->header; }  ?>" class="form-control" placeholder="Competition title" >
								<div class="alert-danger"><?php echo form_error('title'); ?></div>
							</div>

							<div class="form-group">
								<?php echo form_label('Caption'); ?>
								<input type="text" name="caption" id="title" value="<?php if(set_value('caption')!=''){echo set_value('caption');}else{echo $winner->caption; }  ?>" class="form-control" placeholder="Competition caption" >
								<div class="alert-danger"><?php echo form_error('caption'); ?></div>
							</div>
							<div class="form-group">
								<script>
									$(document).ready(function() {
										setup();
									});
								</script>
								<?php echo form_label('Content'); ?>
								<textarea class="form-control" id="content" name="content" rows="20"><?php if(set_value('content')!=''){echo set_value('content');}else{echo $winner->content; }  ?></textarea>
								<div class="alert-danger"><?php echo form_error('content'); ?></div>
							</div>

							<div class="form-group">
								<?php echo form_label('Game'); ?>
								<select name="game" class="form-control">
									<option value="is_49s" <?php if(set_value('game')=='is_49s' || $winner->is_49s=='1'){echo 'selected';} ?>>49s</option>
									<option value="is_ilb" <?php if(set_value('game')=='is_ilb' || $winner->is_ilb=='1'){echo 'selected';} ?>>Irish Lotto</option>
									<option value="is_ra" <?php if(set_value('game')=='is_ra' || $winner->is_ra=='1'){echo 'selected';} ?>>Rapido</option>
									<option value="is_vgr" <?php if(set_value('game')=='is_vgr' || $winner->is_vgr=='1'){echo 'selected';} ?>>Virtual Greyhound Racing</option>
									<option value="is_vhr" <?php if(set_value('game')=='is_vhr' || $winner->is_vhr=='1'){echo 'selected';} ?>>Virtual Horse Racing</option>
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







