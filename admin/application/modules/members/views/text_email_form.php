					<div class="form-group">
					  <label class="col-md-2 control-label" for="textarea">Email Content</label>
					  <div class="col-md-10">
					    <textarea class="form-control" id="emailcontent" name="emailcontent" rows="20">Write new email or load email template form underneath...</textarea>
					  </div>

					</div>

					<div class="form-group">
					  <label class="col-md-2 control-label" for="textarea">Templates</label>
					  <div class="col-md-10">

						 <table class="table table-striped table-bordered table-condensed table-hover" id="template-table">
							<thead>
								<tr>
									<th>Template Name</th>
									<th>Last Used</th>
									<th>Created Date</th>
									<th>Load template</th>
									<th>Delete Template</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($templates as $template){?>
								<tr>
									<td><?php echo $template->template_name;?></td>
									<td><?php echo $template->last_used;?></td>
									<td><?php echo $template->created;?></td>
									<td>
										<a class="btn btn-success btn-xs" href="javascript:;" onclick="loadTextEmailContent(<?php echo $template->id;?>);return false;"><span class="fa fa-arrow-up"></span> Load Template</a>
									</td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? deleteEmailTemplate($(this),<?php echo $template->id;?>) : false;" ><span class="fa fa-trash-o"></span> Delete</a>
									</td>
						 		</tr>
							<?php }?>
							</tbody>
						</table>

					  </div>
					</div>