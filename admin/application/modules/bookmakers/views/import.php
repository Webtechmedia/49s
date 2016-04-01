<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				<?php echo $title;?>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body" id="panel-body">
					<?php if(isset($upload_data)){?>
					<div class="alert alert-success" role="alert">
						<?php
							echo 'File successfully uploaded</br>';
							echo 'File name: '.$upload_data['upload_data']['file_name'].'</br>';
							echo 'File size: '.$upload_data['upload_data']['file_size'].'<br/><br/>';
							echo form_open('bookmakers/processfile');
								$data = array('filename'  => $upload_data['upload_data']['file_name'] );
								echo form_hidden($data);
								echo '<input type="submit" value="Import File to Databese" class="btn btn-primary" />';
							echo form_close();
						?>
	 				</div>
					<?php }?>
					<?php echo form_open_multipart('bookmakers/do_upload');?>
					<div class="form-group">
					  	<label class="col-md-2 control-label" for="textarea">Choose File</label>
					  	<div class="col-md-10">
				 			 <input type="file" name="userfile" class="btn btn-success" />
					  	</div>
					</div><br/><br/><br/>
					<div class="form-group">
					  	<label class="col-md-2 control-label" for="textarea">Submit</label>
					  	<div class="col-md-10">
				 			  <input type="submit" value="Upload" class="btn btn-success" />
					  	</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>
