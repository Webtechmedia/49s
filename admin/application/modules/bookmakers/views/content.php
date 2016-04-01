<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				<?php echo $title;?>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<?php echo form_open_multipart('bookmakers/do_upload');?>
						<label class="col-md-1 control-label" for="userfile">Import File</label>
					  	<div class="col-md-3">
	    					<div class="input-group">
								<span class="btn btn-default btn-file">
							 	   Browse <input type="file" name="userfile" id="userfile">
								</span>
						     	 <span class="input-group-btn" style="width:150px">
						      		  <input type="submit" value="Upload" class="btn btn-primary" />
						     	 </span>
						    </div>
					  	</div>
					<?php echo form_close();?>
					<a class="btn btn-primary pull-right" href="<?php echo base_url('bookmakers/addnew')?>" role="button"><span class="fa fa-plus"></span> Add New Bookmaker</a>
				</div>
				<div class="panel-heading clearfix">

					<div class="toolbar-search">
						<?php echo form_open('bookmakers/setSearch');?>
					    <div class="input-group">
					      <input type="text" name="bookmakers_search" onkeyup="if (event.keyCode == 13) this.form.submit();" value="<?php echo $this->session->userdata('bookmakers_search'); ?>" class="form-control" placeholder="Search...">
					      <span class="input-group-btn">
					        <button class="btn btn-default" onClick="this.form.submit()" type="submit">Search</button>
					      </span>
					    </div>
					    <?php echo form_close();?>
					</div>
				</div>

				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th><?php echo $reference_sort;?></th>
								<th><?php echo $company_name_sort;?></th>
								<th><?php echo $address1_sort;?></th>
								<th><?php echo $address2_sort;?></th>
								<th><?php echo $address3_sort;?></th>
								<th><?php echo $postcode_sort;?></th>
								<th><?php echo $country_code_sort;?></th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php if(!empty($bookmakers)):?>
                        <?php foreach($bookmakers as $bookmaker):?>
                            <tr>
								<td><?php echo $bookmaker->B_Reference; ?></td>
								<td><?php echo $bookmaker->B_CompanyName;?></td>
								<td><?php echo $bookmaker->B_Address1; ?></td>
								<td><?php echo $bookmaker->B_Address2; ?></td>
								<td><?php echo $bookmaker->B_Address3; ?></td>
								<td><?php echo $bookmaker->B_Postcode; ?></td>
								<td><?php echo $bookmaker->B_CountryCode; ?></td>
								<td>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('bookmakers/edit/'.$bookmaker->B_Id.'/'.$offset)?>" role="button"><span class="fa fa-pencil-square-o"></span> Edit</a>
								</td>
								<td>
									<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? true : false;" href="<?php echo base_url('bookmakers/deleteBookmaker/'.$bookmaker->B_Id.'/'.$offset)?>"><span class="fa fa-trash-o"></span> Delete</a>
								</td>
							</tr>
						<?php endforeach;?>
						<?php endif;?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer clearfix">
					<?php echo $this->pagination->create_links();?>
					<div class="toolbar-search">
					   	<div class="pull-right">
			             	<p>Total results: <?php echo $total_results;?></p>
			        	</div>
					</div>
					<div class="toolbar-delimiter">
						<?php echo form_open('bookmakers/setDelimiter');?>
					    <div class="input-group">
						 	<select  name="bookmaker_delimiter" class="form-control" onchange="this.form.submit()">
								<option value="50" <?php if($this->session->userdata('bookmaker_delimiter')=='50'){echo 'selected';} ?>>50</option>
								<option value="100" <?php if($this->session->userdata('bookmaker_delimiter')=='100'){echo 'selected';} ?>>100</option>
								<option value="200" <?php if($this->session->userdata('bookmaker_delimiter')=='200'){echo 'selected';} ?>>200</option>
								<option value="500" <?php if($this->session->userdata('bookmaker_delimiter')=='500'){echo 'selected';} ?>>500</option>
								<option value="1000" <?php if($this->session->userdata('bookmaker_delimiter')=='1000'){echo 'selected';} ?>>1000</option>
							</select>
					    </div>
						<?php echo form_close();?>
					</div>
			    </div>
			</div>
		</div>

	</div>
</div>
