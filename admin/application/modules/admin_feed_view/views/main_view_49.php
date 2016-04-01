<div class="container">
	<h1 class="page-header">
		<?php echo $heading_title;?>
	</h1>
	<?php if($this->session->flashdata('error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
		</div>
	<?php }?>
	<?php if($this->session->flashdata('success')!=''){?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
		</div>
	<?php }?>
	<?php
		$this->session->set_userdata('game', $this->uri->segment(2));
		$attributes = array('id' => 'lottery-form');
		echo form_open('/admin_feed_view/bulkDelete',$attributes);
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					Select game date<br/>
					<?php if( $game_type == 'dog' || $game_type == 'horse' || $game_type == 'ra' ){ ?>
					<select id="date_select_day" class="form-control date-select" url="<?php echo $url . '/' . $game_type ?>">
						<?php for($year = 1 ; $year < 32 ; $year++){ ?>
							<option <?php echo( ( $year == date("d") ) ? 'selected' : '') ?> value="<?php echo $year ?>"><?php echo $year ?></option>
						<?php } ?>
					</select>
					<?php } ?>
					<select id="date_select_month" class="form-control date-select" url="<?php echo $url . '/' . $game_type ?>">
						<option <?php echo( ( 1 == date("m") ) ? 'selected' : '') ?> value="1">January</option>
						<option <?php echo( ( 2 == date("m") ) ? 'selected' : '') ?> value="2">February</option>
						<option <?php echo( ( 3 == date("m") ) ? 'selected' : '') ?> value="3">March</option>
						<option <?php echo( ( 4 == date("m") ) ? 'selected' : '') ?> value="4">April</option>
						<option <?php echo( ( 5 == date("m") ) ? 'selected' : '') ?> value="5">May</option>
						<option <?php echo( ( 6 == date("m") ) ? 'selected' : '') ?> value="6">June</option>
						<option <?php echo( ( 7 == date("m") ) ? 'selected' : '') ?> value="7">July</option>
						<option <?php echo( ( 8 == date("m") ) ? 'selected' : '') ?> value="8">August</option>
						<option <?php echo( ( 9 == date("m") ) ? 'selected' : '') ?> value="9">September</option>
						<option <?php echo( ( 10 == date("m") ) ? 'selected' : '') ?> value="10">October</option>
						<option <?php echo( ( 11 == date("m") ) ? 'selected' : '') ?> value="11">November</option>
						<option <?php echo( ( 12 == date("m") ) ? 'selected' : '') ?> value="12">December</option>
					</select>
					<select id="date_select_year" class="form-control date-select" url="<?php echo $url . '/' . $game_type ?>">
						<?php for($year = 1991 ; $year <= date("Y") ; $year++){ ?>
						<option <?php echo( ( $year == date("Y") ) ? 'selected' : '') ?> value="<?php echo $year ?>"><?php echo $year ?></option>
						<?php } ?>
					</select>


				</div>
				<div class="panel-body">
				 	<div id="result"></div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
</div>










