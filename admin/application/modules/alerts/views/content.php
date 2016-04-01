<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Alerts</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover" >
						<thead>
						<tr>
							<th>URL</th>
							<th>Image</th>
							<th>Remove</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($records as $row) { ?>
							<tr>
								<td>
									<a href="<?php echo $row->link  ?>"><?php echo $row->link  ?></a>
								</td>
								<td>
									<?php if(strlen($row->img) > 5){ ?>
										<img width="100%" style="max-width:500px;" src="<?php echo base_url($row->img) ?>">
									<?php } ?>
								</td>
								<td>
									<a class="btn btn-danger btn-xs" href="<?php echo base_url('/alerts/remove_content/' . $row->id ) ?>" onclick="return confirm('This item will be deleted! This action cannot be undone. Are you sure you want to do this?') ? true : false;"><span class="fa fa-trash-o"></span> Delete</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<form method="post" action="" id="images_update">
						<div class="error" id="error_header_uploader" style="display:none;"></div>
						<table class="table table-striped table-bordered table-condensed table-hover">
							<tr>
								<td>
									<label>Image file</label>
									<input id="image" name="image" type="file" class="btn btn-success btn-xs"/><br/><br/>
									<img width="320" height="240" id="temp_image" src="">
								</td>
								<td>
									<label>URL</label>
									<input id="url" name="url" type="text" class="btn btn-success btn-xs"/><br/><br/>
								</td>
							</tr>
						</table>
						<input type="submit" id="update_submit" class="btn btn-primary pull-right" role="button" style="display:none;" value="Add new Image or Video"/><br/><br/>
						<input type="hidden" name="upload_type" value="home_slider" />
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
	$(document).ready(function() {
		$("#image").change(function(  ) {
			event.preventDefault();
			//alert( "Handler for .submit() called." );
			postImage();
		});
		$( "#images_update" ).submit(function( event ) {
			event.preventDefault();
			//alert( "Handler for .submit() called." );
			var jqxhr = $.post( "<?php echo base_url('/alerts/save_image_video' ) ?>", {
				url: $( "#url" ).val()
			})
				.done(function(data) {
					if(data.server_obj.success == true){
						$("#temp_image").attr('src',data.body);
						$("#update_submit").show();
						$("#error_header_uploader").hide();
						location.reload();
					} else {
						$("#error_header_uploader").hide();
						$("#error_header_uploader").show();
						$("#error_header_uploader").html(data.server_obj.error_msg);
						$("#update_submit").hide();
					}
				})
				.fail(function() {
					//alert( "error" );
					//location.reload();
				})
				.always(function() {
					//alert( "finished" );
				});
		});
	});
	function postImage(){
		$.ajax({
			url: "<?php echo base_url('/alerts/prepare_image')  ?>",
			type: "POST",
			data:  new FormData($("#images_update")[0]),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				//alert(data.server_obj.success);
				//data = jQuery.parseJSON( data );
				if(data.server_obj.success == true){
					$("#error_header_uploader").hide();
					$("#temp_image").attr('src',data.body);
					$("#update_submit").show();
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
