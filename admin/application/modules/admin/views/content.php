<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				Admin Users
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12"></div>
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<a class="btn btn-primary pull-right" href="<?php if ($this->config->item('allow_registration', 'tank_auth')) echo base_url('/auth/register/'); ?>" role="button"><span class="fa fa-plus"></span> Add New Admin</a>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Role</th>
								<th>Status</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
                        <?php foreach($admins as $admin):?>
                                <tr>
								<td><?php echo $admin->id;?></td>
								<td><?php echo $admin->first_name;?></td>
								<td><?php echo $admin->last_name;?></td>
								<td><?php echo $admin->username;?></td>
								<td><?php echo $admin->email;?></td>
								<td><?php echo $admin->role;?></td>
								<td><?php
									if ($admin->activated == 1) {?>
										<a class="btn btn-success btn-xs" onclick="return confirm('This user will be deactivated and access to admin section will be denied! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/auth/deactivate/'.$admin->id); ?>"><span class="fa fa-plus "></span> Active</a>
									<?php } else {?>
										<a class="btn btn-danger btn-xs" href="<?php echo base_url('/auth/activate/'.$admin->id);?>" role="button"><span class="fa fa-minus"></span> Inactive</a>
									<?php }?>
                                </td>
								<td>
									<a class="btn btn-danger btn-xs" href="<?php echo base_url('/auth/unregister/'.$admin->id);?>" onclick="return confirm('This user will be deleted! This action cannot be undone Are you sure you want to do this?') ? true : false;"><span class="fa fa-trash-o"></span> Delete</a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
