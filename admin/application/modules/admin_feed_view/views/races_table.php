<?php if(count($get_events) > 0){ ?>
	<!--  <span>Game Code: <span class="badge"><?php echo $get_events[0]->category  ?></span></span>
	<span>Country: <span class="badge"><?php echo $get_events[0]->country  ?></span></span>
	<span>Date: <span class="badge"><?php echo $get_events[0]->date  ?></span></span><br/><br/>-->
	<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
		<thead>
			<tr>
				<th>Race ID</th>
				<th>Meeting name</th>
				<th>Date time</th>
				<th>Name</th>
				<th>Finish place</th>
				<th>Running number</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($get_events as $get_event){ ?>
			<?php //var_dump($get_event) ?>
			<?php foreach($get_event->events as $event){ ?>
				<?php //var_dump($event) ?>
				<?php foreach($event->draws as $drawn){ ?>
					<?php //var_dump($drawn) ?>

		  			<?php foreach($drawn->numbers as $number){ ?>
						<tr>
							<td><?php echo $drawn->id_id ?></td>
							<td><?php echo $event->name ?></td>
							<td><?php echo $event->date ?> <?php echo $drawn->time ?></td>
							<td><?php echo $number->name ?></td>
							<td><?php echo $number->position ?></td>
							<td><?php echo $number->runner_number ?></td>
							<td>
								<a class="btn btn-success btn-xs example" href="<?php echo base_url('/feed_view/editrace/'.$number->id);?>"><span class="fa fa-pencil-square-o"></span> Edit</a>
							<td>
								<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/admin_feed_view/deleteRaceRecord/'.$number->id);?>"><span class="fa fa-trash-o"></span> Delete</a>
							</td>
						</tr>
			    	<?php } ?>

				<?php } ?>

			<?php } ?>

		<?php } ?>
		</tbody>
	</table>
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
	   showDialog(url);

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
	function showDialog(url){  //load content and open dialog
	    $("#targetDiv").load(url);
	    $("#targetDiv").dialog("open");
	    $("#targetDiv").dialog( "option", "title", "Edit draw results." );
	}
});
</script>


