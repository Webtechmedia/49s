<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Shareholders</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-footer">
					<form method="post" action="" id="images_update">
						<div class="error" id="error_header_uploader" style="display:none;"></div>
						<input type="hidden" name="id" id="id" value="<?php echo( isset($rec) ? $rec->id : '' ) ?>" />
						<table class="table table-striped table-bordered table-condensed table-hover">
							<tr>
								<td>
									<label>Image file</label>
									<input id="image" name="image" type="file" class="btn btn-success btn-xs"/><br/><br/>
									<img width="320" height="240" id="temp_image" src="<?php echo( isset($rec) ? $rec->img : '' ) ?>">
								</td>
								<td>
									<label>URL</label>
									<input id="url" name="url" type="text" class="btn btn-success btn-xs" value="<?php echo( isset($rec) ? $rec->link : '' ) ?>" /><br/><br/>
								</td>
								<td>
									<label>Provider</label>
									<select name="provider" id="provider">
										<option value="coral">Coral</option>
										<option value="ladbrokes">Ladbrokes</option>
										<option value="williamhill">William Hill</option>
									</select>
								</td>
							</tr>
						</table>
						<input type="submit" id="update_submit" class="btn btn-primary pull-right" role="button" value="Save Shareholder Logo"/><br/><br/>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
	$(document).ready(function() {
		$("#image").change(function( event ) {
			event.preventDefault();
			//alert( "Handler for .submit() called." );
			postImage();
		});
		$( "#images_update" ).submit(function( event ) {
			event.preventDefault();
			//alert( "Handler for .submit() called." );
			var jqxhr = $.post( "<?php echo base_url('/shareholders/save_image_video' ) ?>", {
				url: $( "#url" ).val(),
				id: $( "#id" ).val(),
				provider: $( "#provider" ).val()
			})
				.done(function(data) {
					if(data.server_obj.success == true){
						$("#temp_image").attr('src',data.body);
						//$("#update_submit").show();
						$("#error_header_uploader").hide();
						window.location = '<?php echo(base_url('shareholders')) ?>';
					} else {
						$("#error_header_uploader").hide();
						$("#error_header_uploader").show();
						$("#error_header_uploader").html(data.server_obj.error_msg);
						//$("#update_submit").hide();
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
			url: "<?php echo base_url('/shareholders/prepare_image')  ?>",
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
