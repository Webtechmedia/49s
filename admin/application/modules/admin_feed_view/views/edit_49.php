<form action="" method="post" >
<table class="table table-striped table-bordered table-condensed table-hover" >

	<thead>
		<tr>
			<th>Draw Order</th>
			<th>Number</th>
			<th>Is Bonus</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($numbers as $number){ ?>
			<?php if( $number->bonusnumber == 'N' ){ ?>
				<tr>
					<th><input disabled name="draw[<?php echo $number->id ?>][id_id]" size="8" value="<?php echo $number->id_id ?>" class="transparent"></th>
					<th><input name="draw[<?php echo $number->id ?>][number]" size="3" value="<?php echo $number->number ?>" ></th>
					<th><input disabled name="draw[<?php echo $number->id ?>][bonusnumber]" size="3" value="<?php echo $number->bonusnumber ?>" class="transparent"></th>
				</tr>
			<?php } ?>
		<?php } ?>

	</tbody>
</table>
<table class="table table-striped table-bordered table-condensed table-hover" >
Bonus number<br/>
	<thead>
		<tr>
			<th>Draw Order</th>
			<th>Number</th>
			<th>Is Bonus</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($numbers as $number){ ?>
			<?php if( $number->bonusnumber == 'Y' ){ ?>
				<tr>
					<th><input disabled name="draw[<?php echo $number->id ?>][id_id]" size="8" value="<?php echo $number->id_id ?>" class="transparent"></th>
					<th><input name="draw[<?php echo $number->id ?>][number]" size="3" value="<?php echo $number->number ?>" ></th>
					<th><input disabled name="draw[<?php echo $number->id ?>][bonusnumber]" size="3" value="<?php echo $number->bonusnumber ?>" class="transparent"></th>
				</tr>

			<?php } ?>
		<?php } ?>

	</tbody>
</table>
<input class="btn btn-success pull-right" type="submit" value="Submit">
</form>


