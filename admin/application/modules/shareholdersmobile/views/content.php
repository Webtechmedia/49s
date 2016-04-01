<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Mobile Apps Shareholder Images</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('/shareholdersmobile/change' ) ?>" role="button"><span class="fa fa-plus"></span> Add New</a>
				</div>
				<div class="panel-body" id="upload-section">
					<div class="panel panel-default" >
					  	<div class="panel-heading">Mobile Apps Shareholder Logos</div>
					  	<div class="panel-body">
							<?php foreach($records as $row) { ?>
				             	<div >
			                        <img   src="<?php echo $row->img ?>">
			                        </br><br/>
	 								<a class="btn btn-success btn-xs" href="<?php echo base_url('/shareholdersmobile/change/' . $row->id ) ?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
									<a class="btn btn-danger btn-xs" style="float:right" onclick="return confirm('This item will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('/shareholdersmobile/remove_content/' . $row->id ) ?>"><span class="fa fa-trash-o"></span> Delete</a>
			                        <br/><br/>
			                        <?php if(strlen($row->provider) >1){?>
			                        	<span>Provider: </span>
			                       		<?php echo $row->provider  ?>
			                        <?php } ?>
			                        <?php if(strlen( $row->link ) >2){?>
			                        	<br/>
				                   		url: <a  href="<?php echo  $row->link   ?>" ></span><?php echo  $row->link   ?></a>
				                   		<br/><br/>
				                   	<?php } ?>
						  		</div>
							<?php } ?>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>