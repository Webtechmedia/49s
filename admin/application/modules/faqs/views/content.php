<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">FAQ's</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover" >
						<thead>
						<tr>
							<th>Question</th>
							<th>Answer</th>
							<th>Remove</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($records as $row) { ?>
							<tr>
								<td>
									<?php echo $row->question  ?>
								</td>
								<td>
									<?php echo $row->answer  ?>
								</td>
								<td>
									<a class="btn btn-danger btn-xs" href="<?php echo base_url('/faqs/remove_content/' . $row->id ) ?>" onclick="return confirm('This item will be deleted! This action cannot be undone. Are you sure you want to do this?') ? true : false;"><span class="fa fa-trash-o"></span> Delete</a>
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
									<fieldset>
		                                <div class="form-group">
		                                	<label for="question">Question</label>
		                                	<textarea type="text"  id="question" name="question" rows="4" cols="25" class="form-control" placeholder="Write FAQ question here..." autofocus="autofocus"></textarea>
		                                </div>
		                            </fieldset>
								</td>
								<td>
									<fieldset>
		                                <div class="form-group">
		                                	<label for="answer">Answer</label>
		                                	<textarea type="text"  id="answer" name="answer" rows="12" cols="50"  class="form-control" placeholder="Write FAQ answer here..." ></textarea>
		                                </div>
		                            </fieldset>

								</td>
							</tr>
						</table>
						<input type="submit" id="update_submit" class="btn btn-primary pull-right" role="button" value="Add new FaQ"/><br/><br/>
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
		$( "#images_update" ).submit(function( event ) {
			event.preventDefault();
			//alert( "Handler for .submit() called." );
			var jqxhr = $.post( "<?php echo base_url('/faqs/save_image_video' ) ?>", {
				answer: $( "#answer" ).val(),
				question: $( "#question" ).val()
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

</script>
