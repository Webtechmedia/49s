<?php if(count($get_events) > 0){ ?>
<!-- <span>Game Code: <span class="badge"><?php echo $get_events[0]->events[0]->code  ?></span></span>
<span>Country: <span class="badge"><?php echo $get_events[0]->country  ?></span></span>
<span>Date: <span class="badge"><?php echo $get_events[0]->date  ?></span></span><br/><br/>-->
<div style="overflow: scroll !important;">
<table class="table table-striped table-bordered table-condensed table-hover" >
	<thead>
		<tr>
			<th>Draw ID</th>
			<th>Date Time</th>
			<th>Draw</th>
			<?php if($get_events[0]->events[0]->code =='49' ){ ?>
			<th>Ball 1</th>
			<th>Ball 2</th>
			<th>Ball 3</th>
			<th>Ball 4</th>
			<th>Ball 5</th>
			<th>Ball 6</th>
			<th>Bonus</th>
			<?php }?>
			<?php if($get_events[0]->events[0]->code =='RA'  ){ ?>
			<th>Result</th>
			<th>nb 1</th>
			<th>nb 2</th>
			<th>nb 3</th>
			<th>nb 4</th>
			<th>nb 5</th>
			<th>nb 6</th>
			<th>nb 7</th>
			<th>nb 8</th>
			<th>nb 9</th>
			<th>nb 10</th>
			<th>nb 11</th>
			<th>nb 12</th>
			<th>nb 13</th>
			<th>nb 14</th>
			<th>nb 15</th>
			<th>nb 16</th>
			<th>nb 17</th>
			<th>nb 18</th>
			<th>nb 19</th>
			<th>nb 20</th>
			<?php }?>
			<?php if( $get_events[0]->events[0]->code =='IL' ){ ?>
			<th>Ball 1</th>
			<th>Ball 2</th>
			<th>Ball 3</th>
			<th>Ball 4</th>
			<th>Ball 5</th>
			<th>Ball 6</th>
			<th>Bonus</th>
			<?php }?>

			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($get_events as $get_event){ ?>

		<?php foreach($get_event->events as $event){ ?>
			<?php //var_dump($event) ?>
			<?php foreach($event->draws as $drawn){ ?>
				<?php if(count($drawn->numbers) > 0 ){ ?>
					<tr>
						<td><?php echo $drawn->id_id ?></td>
						<td><?php echo $event->date ?> <?php echo $drawn->time ?></td>
						<td><?php
							if( $get_events[0]->events[0]->code =='IL' ){
								if($drawn->num == 1){
									echo 'Main draw';
								} else if($drawn->num == 2){
									echo '2nd draw';
								} else if($drawn->num == 3){
									echo '3rd draw';
								}
							} elseif($get_events[0]->events[0]->code =='49' ) {
								if($drawn->num == 1 ) {
									echo('Lunch');
								} elseif($drawn->num == 2 ) {
									echo('Evening');
								} else{
									echo('Extra');
								}
							} else {
								echo 'Draw '.$drawn->num;
							}
							?></td>
						<?php $low = 0; ?>
						<?php $high = 0; ?>
						<?php foreach($drawn->numbers as $number){ ?>
							<?php if($number->number <= 40){
								$low++;
							} else {
								$high++;
							}
							?>
							<?php if($get_events[0]->events[0]->code != 'RA') { ?>
								<td><?php echo $number->number ?></td>
							<?php } ?>
						<?php } ?>
						<?php if($get_events[0]->events[0]->code == 'RA') { ?>

							<td>
							<?php if($low > $high) { ?>
								Heads
							<?php } else if($low < $high) { ?>
								Tails
							<?php } else  { ?>
								Level
							<?php }  ?>
							</td>

							<?php
								foreach($drawn->numbers as $number){
									echo '<td>'.$number->number.'</td>';
								}
							?>









						<?php } ?>
						<td>
							<a class="btn btn-success btn-xs example" title="Edit draw #<?php echo $drawn->id_id ?> on <?php echo $event->date ?> <?php echo $drawn->time ?>" href="<?php echo base_url('/feed_view/edit49/'.$drawn->id);?>"><span class="fa fa-pencil-square-o"></span> Edit</a>
						<td>
							<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/admin_feed_view/deleteNumberRecord/'.$drawn->id);?>"><span class="fa fa-trash-o"></span> Delete</a>
						</td>
					</tr>

				<?php } ?>

			<?php } ?>

		<?php } ?>

	<?php } ?>


	</tbody>
</table>
</div>
<?php } else { ?>

NO SCORES
<?php } ?>

<div id="targetDiv">
</div>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
	$('a.example').click(function(){   //bind handlers
		var url = $(this).attr('href');
		var title = $(this).attr('title');
	   showDialog(url,title);

	   return false;
	});

	$("#targetDiv").dialog({  //create dialog, but keep it closed
	   autoOpen: false,
	   height: 600,
	   width: 650,
	   modal: true,
	   open: function(){
           var closeBtn = $('.ui-dialog-titlebar-close');
           $('.ui-button-text').remove();
           closeBtn.append('<span class="ui-button-text">x</span>');
       }
	});

	function showDialog(url,title){  //load content and open dialog
	    $("#targetDiv").load(url);
	    $("#targetDiv").dialog("open");
	    $("#targetDiv").dialog( "option", "title", title );
	}

});
</script>












