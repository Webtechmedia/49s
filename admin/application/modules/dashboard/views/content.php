<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							Latest 5 Members
                        </div>
                        <div class="panel-body">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<tr>
										<th>First Name</th>
										<th>Surname</th>
										<th>Email</th>
										<th>View</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($members as $member){?>
									<tr>
										<td><?php echo $member->U_FirstName;?></td>
										<td><?php echo $member->U_Surname;?></td>
										<td><?php echo $member->U_Email;?></td>
										<td><a class="btn btn-success btn-xs" href="<?php echo base_url('members/editMember/'.$member->U_Id);?>" role="button"><span class="fa fa-eye"></span> View</a></td>
										<td><a class="btn btn-danger btn-xs" href="<?php echo base_url('dashboard/deleteMember/'.$member->U_Id);?>" onclick="return confirm('This user will be deleted! This action cannot be undone Are you sure you want to do this?') ? true : false;"><span class="fa fa-trash-o"></span> Delete</a></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><a href="<?php echo base_url('members');?>">View More</a></span>
                                <span class="pull-right"><a href="<?php echo base_url('members');?>"><i class="fa fa-arrow-circle-right"></i></a></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

</div>
