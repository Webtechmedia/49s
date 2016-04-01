<div class="container">
	<div class="row">
	  	<div class="col-xs-12">
			<h1 class="page-header"><?php echo $title;?></h1>
		</div>
	</div>
    <div class="row">
        <?php echo form_open('bookmakers/updateBookmaker/'.$bookmakerid.'/'.$offset); ?>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title"> <?php echo form_submit('add', 'Save Changes','class="btn btn-success pull-right "'); ?></h3>
                        <a href="<?php echo base_url('bookmakers')?>" class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
                    </div>
                    <div class="panel-body">
                       	<fieldset>
							<div class="form-group">
								<input type="hidden" name="reference" id="reference" value="<?php if(set_value('reference') != ''){ echo set_value('reference'); }else{ echo $bookmaker[0]->B_Reference; } ?>" class="form-control" placeholder="Reference" autofocus="autofocus">
								<div class="alert-danger"><?php echo form_error('reference'); ?></div>
							</div>
							<div class="form-group">
								<?php echo form_label('Company Name'); ?>
								<input type="text" name="company_name" id='company_name' value="<?php if(set_value('company_name') != ''){ echo set_value('company_name'); }else{ echo $bookmaker[0]->B_CompanyName; } ?>" class="form-control" placeholder="Company Name" >
								<div class="alert-danger"><?php echo form_error('company_name'); ?></div>
							</div>
							<div class="form-group">
                            	<?php echo form_label('Address 1'); ?>
                                <input type="text" name="address_1" id="address_1" value="<?php if(set_value('address_1') != ''){ echo set_value('address_1'); }else{ echo $bookmaker[0]->B_Address1; } ?>" class="form-control" placeholder="Address 1" >
                                <div class="alert-danger"><?php echo form_error('address_1'); ?></div>
							</div>
							<div class="form-group">
                            	<?php echo form_label('Address 2'); ?>
                                <input type="text" name="address_2" id="address_2" value="<?php if(set_value('address_2') != ''){ echo set_value('address_2'); }else{ echo $bookmaker[0]->B_Address2; } ?>" class="form-control" placeholder="Address 2" >
                     			<div class="alert-danger"><?php echo form_error('address_2'); ?></div>
               				</div>
						    <div class="form-group">
                            	<?php echo form_label('Address 3'); ?>
								<input type="text" name="address_3" id="address_3" value="<?php if(set_value('address_3') != ''){ echo set_value('address_3'); }else{ echo $bookmaker[0]->B_Address3; } ?>" class="form-control" placeholder="Address 3">
								<div class="alert-danger"><?php echo form_error('address_3'); ?></div>
                            </div>
                            <div class="form-group">
                            	<?php echo form_label('Postcode'); ?>
								<input type="text" name="postcode" id="postcode" value="<?php if(set_value('postcode') != ''){ echo set_value('postcode'); }else{ echo $bookmaker[0]->B_Postcode; } ?>" class="form-control" placeholder="Postcode">
								<div class="alert-danger"><?php echo form_error('postcode'); ?></div>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Country Code'); ?>
								<input type="text" name="country_code" id="country_code" value="<?php if(set_value('country_code') != ''){ echo set_value('country_code'); }else{ echo $bookmaker[0]->B_CountryCode; } ?>" class="form-control" placeholder="Country Code">
								<div class="alert-danger"><?php echo form_error('country_code'); ?></div>
                            </div>
						</fieldset>
                    </div>
                </div>
            </div>
         <?php echo form_close(); ?>
	</div>
</div>







