<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Website Images &amp; Videos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('/uploads/change/' ) ?>" role="button"><span class="fa fa-plus"></span> Add New</a>
				</div>
				<div class="panel-body" id="upload-section">


<h2>General Pages</h2>
<hr/>
				<div class="panel panel-default" >
				  	<div class="panel-heading">Home</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_home == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				<div class="panel panel-default" >
				  	<div class="panel-heading">The Fount</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_oracle == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main; ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				<div class="panel panel-default" >
				  	<div class="panel-heading">Bet Here</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_bet_here == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



 				<div class="panel panel-default" >
				  	<div class="panel-heading">Responsible Gambling</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_responsible == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>
				<div class="panel panel-default" >
				  	<div class="panel-heading">Mobile App</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_mobile == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

<h2>49's</h2>
<hr/>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's Latest Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_last == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's Previous Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_prev == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default">
				  	<div class="panel-heading">49's Hot and Cold</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_h_c == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default"  >
				  	<div class="panel-heading">49's Lucky Dip</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_lucky_dip == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img   src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main  ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's Syndicates</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_syndicates == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main  ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's Presenters</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_winner == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>




				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's How to Play</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_how_to_play == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">49's Rules</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_49s_rule == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

<h2>Irish Lotto Bet</h2>
<hr/>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Latest Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_last == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Previous Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_prev == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Hot and Cold</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_h_c == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main  ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Lucky Dip</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_lucky_dip == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Syndicates</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_syndicates == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB How to Play</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_how_to_play == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default" >
				  	<div class="panel-heading">ILB Rules</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_ilb_rule == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

<h2>Virtual Horse Racing</h2>
<hr/>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">VHR Latest Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vhr_last == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">VHR Previous Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vhr_prev == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">VHR How to Play</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vhr_how_to_play == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				 <div class="panel panel-default" >
				  	<div class="panel-heading">VHR Rules</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vhr_rule == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

<h2>Virtual Greyhound Racing</h2>
<hr/>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">VGR Latest Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vdr_last == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">VGR Previous Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vdr_prev == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">VGR How to Play</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vdr_how_to_play == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				 <div class="panel panel-default" >
				  	<div class="panel-heading">VGR Rules</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_vdr_rule == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


<h2>Rapido</h2>
<hr/>
				 <div class="panel panel-default" >
				  	<div class="panel-heading">Rapido Latest Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_rapido_last == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default" >
				  	<div class="panel-heading">Rapido Previous Results</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_rapido_prev == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main  ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default" >
				  	<div class="panel-heading">Rapido How to Play</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_how_to_play == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>

				 <div class="panel panel-default" >
				  	<div class="panel-heading">Rapido Rules</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_rapido_rule == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


<h2 >Promo Images</h2>
<hr/>

				<div class="panel panel-default" >
				  	<div class="panel-heading">Home Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_home == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				<div class="panel panel-default" >
				  	<div class="panel-heading">49's Latest Results Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_49_latest == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				<div class="panel panel-default" >
				  	<div class="panel-heading">ILB Latest Results Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_ilb_latest == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				<div class="panel panel-default" >
				  	<div class="panel-heading">VHR Latest Results Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_vhr_latest == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>


				<div class="panel panel-default" >
				  	<div class="panel-heading">VGR Latest Results Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_vgr_latest == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



				<div class="panel panel-default" >
				  	<div class="panel-heading">Rapido Latest Results Promo</div>
				  	<div class="panel-body">
						<?php foreach($records as $row) { ?>
					  		<?php if($row->is_promo_rapido_latest == 1 ){ ?>
			             	<div >
			                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
		                        	<img  src="<?php echo $row->url_path_thumb ?>">
		                        	</br><br/>
 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploads/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploads/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
		                        <br/>
		                        <?php } ?>
		                        <?php if(strlen($row->overlay_text) >1){?>
		                        	<p>Caption:</p>
		                       		<?php echo $row->overlay_text;?>
		                        <?php } ?>
		                        <?php if(strlen($row->url) >2){?>
		                        	<br/>
			                   		url: <a  href="<?php echo $row->url  ?>" ></span><?php echo $row->url  ?></a>
			                   		<br/><br/>
			                   	<?php } ?>
								<?php if(strlen($row->url_path_main) > 5){ ?>
									<br/><br/>
			                        <video width="100%" controls>
			                            <source src="<?php echo $row->url_path_main ?>" type="video/mp4">
			                            Your browser does not support the video tag.
			                        </video>
		                        <?php } ?>
					  		</div>
							<?php } ?>
						<?php } ?>
				  	</div>
				</div>



					  		<?php //if($row->is_how_to_play_bgr_49s == 1 ){ ?>
					  		<?php //if($row->is_lucky_dip_bgr_49s == 1 ){ ?>
					  		<?php //if($row->is_how_to_play_bgr_ilb == 1 ){ ?>
					  		<?php //if($row->is_lucky_dip_bgr_ilb == 1 ){ ?>
					  		<?php //if($row->is_how_to_play_bgr_vhr == 1 ){ ?>
					  		<?php //if($row->is_lucky_dip_bgr_vhr == 1 ){ ?>
					  		<?php //if($row->is_how_to_play_bgr_vgr == 1 ){ ?>
					  		<?php //if($row->is_lucky_dip_bgr_vgr == 1 ){ ?>
					  		<?php //if($row->is_how_to_play_bgr_ra == 1 ){ ?>
					  		<?php //if($row->is_lucky_dip_bgr_ra == 1 ){ ?>
				</div>
			</div>
		</div>
	</div>
</div>



