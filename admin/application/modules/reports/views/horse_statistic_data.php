
    <?php if( isset($please_correct_errors )){ ?>
        <div class="error" ><?php echo( $please_correct_errors) ?></div>
    <?php } ?>
	<div class="row">
		<div class="">
            <?php if( isset($data_report) ){ ?>
                <table class="table table-striped table-bordered table-condensed table-hover" >
						<thead>
							<tr>
                        	<th>Date</th>
                        	<th>Time</th>
                        	<th>Track</th>
                        	<th>Runner Name</th>
                        	<th>Runner Number</th>
                        	<th>Odds</th>
                        	<th>Fin</th>
                        	<th>Fav</th>
                        	<th>T/C</th>
                        	<th>F/C</th>
                    		</tr>
						</thead>
						<tbody>
		                <?php foreach( $data_report as $row ){ ?>
		                    <tr>
		                        <td><?php echo $row->date ?></td>
		                        <td><?php echo $row->time ?></td>
		                        
		                        <td><?php echo $row->track ?></td>
		                        <td><?php echo $row->runner_name ?></td>
		                        <td><?php echo $row->runner_number ?></td>
		                        <td><?php echo $row->odds ?></td>
		 
		                        <td><?php echo $row->finish_place ?></td>
		                        <td><?php echo $row->favourite_or_second_favourite ?></td>
		                        <td><?php echo $row->f_c_amount ?></td>
		                        <td><?php echo $row->t_c_amount ?></td>
		                    </tr>
		                <?php } ?>
						</tbody>
					</table>
                </table>
            <?php } ?>
		</div>
	</div>

