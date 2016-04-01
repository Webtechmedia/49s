<div class="panel-body">
	<h3 class="pull-left">Group: <?php echo $group; ?></h3>
	<h3 class="pull-right">Total: <?php echo $count; ?></h3>
	<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Postcode</th>
				<th>Country</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($emails)):?>
        	<?php foreach($emails as $email):?>
       		<tr>
				<td><?php echo $email->U_FirstName;?></td>
				<td><?php echo $email->U_Surname;?></td>
				<td><?php echo $email->U_Email;?></td>
				<td><?php echo $email->U_Postcode;?></td>
				<td><?php echo $email->U_Country;?></td>
			</tr>
		<?php endforeach;?>
		<?php endif;?>
		</tbody>
	</table>
</div>