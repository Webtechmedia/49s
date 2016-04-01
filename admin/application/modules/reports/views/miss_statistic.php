<style>
.ui-draggable{
	width:1180px !important;
	left:80px !important;
	}
</style>

<div class="panel-body">
  	<table class="table table-striped table-bordered table-condensed ">
		<tbody>
			<tr>
				 <td>
					<a class="btn btn-success pull-right" href="<?php echo base_url("index.php/reports/miss_download") ?>">Download</a>
				 </td>
			</tr>
		</tbody>
	</table>   
</div>
<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th>Shop Name</th>
								<th>Shop Number</th>
                                <th>Shop manager</th>
                                <th>Area manager</th>
                                <th>Email</th>
                                <th>Shop - 1st Line Address</th>
                                <th>Shop - Town</th>
                                <th>Shop - County</th>
                                <th>Shop - Postcode</th>
                                <th>IOS Package</th>
                                <th>Android Package</th>
                                <th>Shop Phone</th>
                                 
							</tr>
						</thead>
						<tbody>
                         <?php 
						// print_r($miss_statistics);
						 if(isset($miss_statistics)){ ?>
						<?php foreach($miss_statistics as $miss_one){
							
							//print_r($miss_one);
						?>
                        
							<tr>
								<td>
                                <?php echo $miss_one->shop_name  ?>
                                </td>
								<td>
								<?php echo $miss_one->shop_number  ?>	
								</td>
                                <td>
                                <?php echo $miss_one->s_m_full_name  ?>	
                                </td>
								<td>
								 <?php echo $miss_one->a_m_full_name  ?>		
								</td>
                                 <td>
                                 <?php echo $miss_one->email_address  ?>	
                                </td>
                                <td>
                                 <?php echo $miss_one->shop_address  ?>	
                                </td>
                                <td>
                                 <?php echo $miss_one->shop_address2  ?>	
                                </td>
                                <td>
                                 <?php echo $miss_one->shop_address3  ?>	
                                </td>
                                <td>
                                 <?php echo $miss_one->postcode  ?>	
                                </td>
                                 <td>
                                 <?php echo $miss_one->iospackage  ?>	
                                </td>
                                 <td>
                                 <?php echo $miss_one->androidpackage  ?>	
                                </td>
								<td>
								 <?php echo $miss_one->shop_phone  ?>		
								</td>
                                
							</tr>
						<?php }} ?>
						</tbody>
					</table>