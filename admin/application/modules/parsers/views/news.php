<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <tr>
        	<?php foreach($users as $user):?>
	        	<td>
	        		<?php echo $user->username;?>
	        	</td>
	        	<td>
	        		<?php echo $user->email;?>
	        	</td>
        	<?php endforeach; ?>
        </tr>
    </thead>
</table>
 
