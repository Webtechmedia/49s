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
				<div class="panel-heading clearfix">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('winners/addnewwinner')?>" role="button"><span class="fa fa-plus"></span> Add New Winner</a>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th>Image</th>
								<th>Title</th>
								<th>Content</th>
								<!--  <th>Game</th> -->
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($winners)){ ?>
						<?php foreach($winners as $winner){?>
							<tr>
								<td>
									<?php echo '<img src="../../'.$winner->main_img.'" class="img-thumbnail" width="100px"/>';?>
								</td>
								<td>
									<?php echo $winner->header;?>
								</td>
								<td>
									<?php echo $winner->content;?>
								</td>
								<!--  <td>
									<?php if($winner->W_Game=='0'){echo '49s';}?>
									<?php if($winner->W_Game=='1'){echo 'Irish Lotto';}?>
									<?php if($winner->W_Game=='2'){echo 'Rapido';}?>
									<?php if($winner->W_Game=='3'){echo 'Virtual Greyhound Racing';}?>
									<?php if($winner->W_Game=='4'){echo 'Virtual Horse Racing';}?>
								</td>-->
								<td>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('winners/edit/'.$winner->id)?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								</td>
								<td>
									<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('winners/deleteWinner/'.$winner->id)?>"><span class="fa fa-trash-o"></span> Delete</a>
								</td>
							</tr>
						<?php } ?>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer clearfix">


			    </div>
			</div>
		</div>

	</div>
</div>
