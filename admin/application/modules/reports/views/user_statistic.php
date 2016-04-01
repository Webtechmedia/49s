<div class="panel-body">
  	<table class="table table-striped table-bordered table-condensed ">
		<tbody>
			<tr>
				 <td>
					<a class="btn btn-success pull-right" href="<?php echo base_url("index.php/reports/users_download") ?>">Download</a>
				 </td>
			</tr>
		</tbody>
	</table>   
</div>
<table class="table table-striped table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>Figure</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
          	<tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_users ?>"> </span></td><td>Registered Members</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_valid_for_contest_users ?>"> </span></td><td>Valid for contest (Country GB or UK)</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_49 ?>"> </span></td><td>Members play 49s </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_49_percentage ?>"> </span></td><td>% of members play 49s </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_ilb ?>"> </span></td><td>Members play Irish Lotto</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_ilb_percentage ?>"> </span></td><td>% of members play Irish Lotto</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_ra ?>"> </span></td><td>Members play Rapido </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_ra_percentage ?>"> </span></td><td>% of members play Rapido</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_vh ?>"> </span></td><td>Members play Virtual Horse Racing </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_vh_percentage ?>"> </span></td><td>% of members play Virtual Horse Racing </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_vd ?>"> </span></td><td>Members play Virtual Greyhound Racing </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_play_vd_percentage ?>"> </span></td><td>% of members play Virtual Greyhound Racing </h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_male ?>"> </span></td><td>Males members</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->total_female ?>"> </span></td><td>Females members</h10></td></tr>
       
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_18_29 ?>"> </span></td><td>Age 18-29</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_30_39 ?>"> </span></td><td>Age 30-39</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_40_49 ?>"> </span></td><td>Age 40-49</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_50_59 ?>"> </span></td><td>Age 50-59</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_60_69 ?>"> </span></td><td>Age 60-69</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_70_79 ?>"> </span></td><td>Age 70-79</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->age_80 ?>"> </span></td><td>Age 80+</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->avg_age ?>"> </span></td><td>Avarage age</h10></td></tr>
            <tr><td><h10 class=""><span class=""><input disabled class="transparent" maxlength="5" size="5" value="<?php echo $user_statistics->common_age ?>"> </span></td><td>Most common age</h10></td></tr>
             
	</tbody>
</table>