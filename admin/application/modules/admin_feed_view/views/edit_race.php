<?php //var_dump( $this->input->post() ) ?>

<form action="" method="post" >
	<table class="table table-striped table-bordered table-condensed table-hover" >

		<?php foreach($racer as $race){ ?>
			<tr>
				<th>Runner Number</th>
				<input name="racew[<?php echo $race->id_id ?>][id]" size="26" type="hidden" value="<?php echo $race->id  ?>" >
				<th><input name="racew[<?php echo $race->id_id ?>][runner_number]" size="26" value="<?php echo $race->runner_number ?>" ></th>
			</tr>
			<tr>
				<th>Runner Name</th>
				<th><input name="racew[<?php echo $race->id_id ?>][name]" size="26" value="<?php echo $race->name ?>" ></th>
			</tr>
			<tr>
				<th>Finish Place</th>
				<th><input name="racew[<?php echo $race->id_id ?>][position]" size="26" value="<?php echo $race->position ?>" ></th>
			</tr>
			<tr>
				<th>Odds</th>
				<th><input name="racew[<?php echo $race->id_id ?>][sp]" size="26" value="<?php echo $race->sp ?>" ></th>
			</tr>
			<tr>
				<th>TC</th>
				<th><input name="racew[<?php echo $race->id_id ?>][tc]" size="26" value="<?php echo $race->num ?>" ></th>
			</tr>
			<tr>
				<th>FC</th>
				<th><input name="racew[<?php echo $race->id_id ?>][fc]" size="26" value="<?php echo $race->num ?>" ></th>
			</tr>
		<?php } ?>

	</table>
	<input class="btn btn-success pull-right" type="submit" value="Save" name="save"/>
	<input class="btn btn-danger pull-right distance-right" type="submit" value="Delete race" name="del_race"/>
	<input class="btn btn-danger pull-right distance-right" type="submit" value="Delete position" name="del_pos"/>
</form>


