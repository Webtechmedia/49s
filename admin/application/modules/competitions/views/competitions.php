<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Competitions</h1>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<a class="btn btn-primary pull-right" href="<?php echo base_url('competitions/add')?>" role="button"><span class="fa fa-plus"></span> Add New Competition</a>
		</div>
  		<div class="panel-body">
  			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Competition Title</th>
						<th>Localization</th>
						<th>From</th>
						<th>To</th>
						<th>Created</th>
						<th>Draw Date</th>
						<th>View</th>
						<th>Edit</th>
						<th>Status</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php if($competitions){?>
					<?php foreach($competitions as $competition){?>
                	<tr>
						<td><?php echo $competition->id;?></td>
						<td><?php echo $competition->title;?></td>
						<td><?php if($competition->localization==0){echo 'UK only';}elseif($competition->localization==1){echo 'Foreign only';}elseif($competition->localization==2){echo 'All localizations';} ?></td>
						<td><?php echo date("Y-m-d H:i:s",strtotime($competition->date_from)); ?></td>
						<td><?php echo $competition->date_to;?></td>
						<td><?php echo $competition->create_date;?></td>
						<td><?php echo $competition->draw_date;?></td>
						<td><a class="btn btn-success btn-xs" href="<?php echo base_url('/competitions/viewCompetition/'.$competition->id);?>" role="button"><span class="fa fa-eye"></span> View</a></td>
						<td><a class="btn btn-success btn-xs" href="<?php echo base_url('/competitions/editCompetition/'.$competition->id);?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a></td>
						<td>
							<?php
							if ($competition->status == 1) {?>
								<a class="btn btn-success btn-xs" onclick="return confirm('Competition will be deactivated! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/competitions/deactivate/'.$competition->id); ?>"><span class="fa fa-plus"></span> Active</a>
							<?php } else {?>
								<a class="btn btn-danger btn-xs" href="<?php echo base_url('/competitions/activate/'.$competition->id);?>" role="button"><span class="fa  fa-minus"></span> Inactive</a>
							<?php }?>
						</td>
						<td>
							<a class="btn btn-danger btn-xs" href="<?php echo base_url('/competitions/delete/'.$competition->id);?>" onclick="return confirm('This user will be deleted! This action cannot be undone Are you sure you want to do this?') ? true : false;"><span class="fa fa-trash-o"></span> Delete</a>
						</td>
					</tr>
					<?php }?>
				<?php }?>
				</tbody>
			</table>
  		</div>
  		<div class="panel-footer">
  		</div>
	</div>

</div>
