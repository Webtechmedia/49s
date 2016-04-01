<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Mobile Apps Images &amp; Videos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('/uploadsmobile/change/' ) ?>" role="button"><span class="fa fa-plus"></span> Add New</a>
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
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">49's Lucky Dip</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_49s_lucky_dip == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">ILB Lucky Dip</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_ilb_lucky_dip == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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

<h2>Virtual Grayhound Racing</h2>
<hr/>
					<div class="panel panel-default" >
					  	<div class="panel-heading">VGR Latest Results</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_vdr_last == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">Rapido How to Play</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_how_to_play == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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










<h2>Backgrounds</h2>
<hr/>
					<div class="panel panel-default" >
					  	<div class="panel-heading">49's How to Play Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_how_to_play_bgr_49s == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">49's Lucky Dip Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_lucky_dip_bgr_49s == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">ILB How to Play Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_how_to_play_bgr_ilb == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">ILB Lucky Dip Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_lucky_dip_bgr_ilb == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">VHR How to Play Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_how_to_play_bgr_vhr == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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
					  	<div class="panel-heading">Rapido How to Play Background</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
						  		<?php if($row->is_how_to_play_bgr_ra == 1 ){ ?>
				             	<div >
				                    <?php if(strlen($row->url_path_thumb) > 5){ ?>
			                        	<img   src="<?php echo $row->url_path_thumb ?>">
			                        	</br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/uploadsmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/uploadsmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
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

				</div>
			</div>
		</div>
	</div>
</div>





			<script>
                $(document).ready(function() {
                    $("#image").change(function(  ) {
                        event.preventDefault();
                        //alert( "Handler for .submit() called." );
                        postImage();
                    });
                    $("#video").change(function(  ) {
                        event.preventDefault();
                        //alert( "Handler for .submit() called." );
                        postVideo();
                    });
                    $( "#images_update" ).submit(function( event ) {
                        event.preventDefault();
                        //alert( "Handler for .submit() called." );
                        var jqxhr = $.post( "<?php echo base_url('/uploadsmobile/save_image_video' ) ?>", {
							overlay_textet: $( "#overlay_textet" ).val(),
							url: $( "#url" ).val(),
                            type: $( "#upload_type" ).val()
                        })
                        .done(function(data) {
                                if(data.server_obj.success == true){
                                    $("#temp_image").attr('src',data.body);
                                    $("#update_submit").show();
                                    $("#error_header_uploader").hide();
                                    location.reload();
                                } else {
                                    $("#error_header_uploader").hide();
                                    $("#error_header_uploader").show();
                                    $("#error_header_uploader").html(data.server_obj.error_msg);
                                    $("#update_submit").hide();
                                }
                        })
                        .fail(function() {
                            //alert( "error" );
                            //location.reload();
                        })
                        .always(function() {
                            //alert( "finished" );
                        });
                	});
                });
                function postImage(){
                    $.ajax({
                        url: "<?php echo base_url('/uploadsmobile/prepare_image')  ?>",
                        type: "POST",
                        data:  new FormData($("#images_update")[0]),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            //alert(data.server_obj.success);
                            //data = jQuery.parseJSON( data );
                            if(data.server_obj.success == true){
                                $("#error_header_uploader").hide();
                                $("#temp_image").attr('src',data.body);
                                $("#update_submit").show();
                            } else {
                                $("#error_header_uploader").hide();
                                $("#error_header_uploader").show();
                                $("#error_header_uploader").html(data.server_obj.error_msg.error);
                                $("#update_submit").hide();
                            }
                        }
                    });
                }
                function postVideo(){
                    $.ajax({
                        url: "<?php echo base_url('/uploadsmobile/prepare_video') ?>",
                        type: "POST",
                        data:  new FormData($("#images_update")[0]),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data){
                            //alert(data.server_obj.success);
                            //data = jQuery.parseJSON( data );
                            if(data.server_obj.success == true){
                                //$("#temp_image").attr('src',data.body);
                                //$("#temp_video video source").attr('src', data.body);
                                $('#video_src').attr('src', data.body);
                                $('#temp_video').get(0).load();
                                $("#temp_video").get(0).play();;

                                $("#update_submit").show();
                                $("#error_header_uploader").hide();
                            } else {
                                $("#error_header_uploader").hide();
                                $("#error_header_uploader").show();
                                $("#error_header_uploader").html(data.server_obj.error_msg.error);
                                $("#update_submit").hide();
                            }
                        }
                    });
                }
            </script>
