<div class="row">

	<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
                        	<th>Date</th>
                        	<th>Off Time</th>
                        	<th>Draw</th>
                        	<th>Numbers</th>
                        	<?php if($type!='ra'){?><th>Bonus</th><?php }?>
                    	</tr>
					</thead>
					<tbody>
					<?php foreach($events as $event){?>
						<tr>
                            <td><?php echo $event->date; ?></td>
                            <td><?php echo $event->offtime; ?></td>
                   			<td>
                   			<?php if($type=='49'){ ?>
                   				<?php if($event->num==1){ echo 'LUNCHTIME DRAW';}  ?>
                   				<?php if($event->num==2){ echo 'TEATIME DRAW';}  ?>
                   				<?php if($event->num==3){ echo '3RD DRAW';}  ?>
                   				<?php if($event->num==4){ echo '4TH DRAW';}  ?>
                   			<?php } ?>
                   			<?php if($type=='il'){ ?>
                   				<?php if($event->num==1){ echo 'MAIN DRAW';}  ?>
                   				<?php if($event->num==2){ echo '2ND DRAW';}  ?>
                   				<?php if($event->num==3){ echo '3RD DRAW';}  ?>
                   				<?php if($event->num==4){ echo '4RD DRAW';}  ?>
                   				<?php if($event->num==5){ echo '5RD DRAW';}  ?>
                   				<?php if($event->num==6){ echo '6RD DRAW';}  ?>
                   			<?php } ?>
                   			<?php if($type=='ra'){ ?>
                   				<?php if($event->num==1){ echo 'DRAW 1';}  ?>
                   				<?php if($event->num==2){ echo 'DRAW 2';}  ?>
                   				<?php if($event->num==3){ echo 'DRAW 3';}  ?>
                   				<?php if($event->num==4){ echo 'DRAW 4';}  ?>
                   				<?php if($event->num==5){ echo 'DRAW 5';}  ?>
                   				<?php if($event->num==6){ echo 'DRAW 6';}  ?>
                   				<?php if($event->num==7){ echo 'DRAW 7';}  ?>
                   				<?php if($event->num==8){ echo 'DRAW 8';}  ?>
                   				<?php if($event->num==9){ echo 'DRAW 9';}  ?>
                   				<?php if($event->num==10){ echo 'DRAW 10';}  ?>
                   				<?php if($event->num==11){ echo 'DRAW 11';}  ?>
                   				<?php if($event->num==12){ echo 'DRAW 12';}  ?>
                   				<?php if($event->num==13){ echo 'DRAW 13';}  ?>
                   				<?php if($event->num==14){ echo 'DRAW 14';}  ?>
                   				<?php if($event->num==15){ echo 'DRAW 15';}  ?>
                   				<?php if($event->num==16){ echo 'DRAW 16';}  ?>
                   			<?php } ?>
                   			</td>
                   			<td><?php echo $event->numbers; ?></td>
                   			<?php if($type!='ra'){ ?>
                   			<td><?php if(isset($event->bonus)){ echo $event->bonus;}  ?></td>
                   			<?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
</div>
