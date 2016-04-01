<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">
				<?php echo $title;?>
			</h1>
		</div>
	</div>
	<div class="row">
		<?php
			$attributes = array('id' => 'email-form');
			echo form_open('/members/submitEmail',$attributes);
		?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<form class="form-horizontal col-xs-6">
						<div class="form-group">
						  <label class="col-md-2 control-label" for="radios">Email Type</label>
						  <div class="col-md-4">
						  <script>
								$(document).ready(function() {
								    $('input[type=radio][name=email-type]').change(function() {
								        if (this.value == 'text') {
											$.ajax({
											        url: "<?php echo base_url('members/sendTextEmail');?>",
											        type: "POST",
											        data:  ''
											}).done(function(data){
												tinymce.get($("textarea").attr('id')).hide();
											    $('#panel-body').html( data );
											});
								        }
								        else if (this.value == 'html') {
											$.ajax({
											        url: "<?php echo base_url('members/sendHtmlEmail');?>",
											        type: "POST",
											        data:  ''
											}).done(function(data){
												$('#panel-body').html( data );
												setup();
											});
								        }
								    });
								});
								function loadTextEmailContent(id){
									$.ajax({
								        url: "<?php echo base_url('members/getTextEmailContent');?>/"+id,
								        type: "POST",
								        data:  ''
									}).done(function(data){
										$("#emailcontent").val(data);
									});
								}
								function loadHtmlEmailContent(id){
									$.ajax({
								        url: "<?php echo base_url('members/getHtmlEmailContent');?>/"+id,
								        type: "POST",
								        data:  ''
									}).done(function(data){
										tinymce.activeEditor.setContent('');
										tinymce.execCommand('mceInsertContent',false,data);
									});
								}
								function deleteEmailTemplate(thisObj,id){
									$.ajax({
								        url: "<?php echo base_url('members/deleteEmailTemplate');?>/"+id,
								        type: "POST",
								        data:  ''
									}).done(function(data){
										if (data==1){
											thisObj.closest('tr').fadeOut('slow', function(){
												$(this).parents('tr:first').remove();
											});
										}else{
											alert('Error deleting templte !');
										}

									});

								}
								function saveNewTemplate(type){
									var selected = $("input[type='radio'][name='email-type']:checked");
									var subject = $("#subject").val();
									var content =$('#emailcontent').val();
									if(subject!=''){
										if (selected.val()=='text') {
											$.ajax({
										        url: "<?php echo base_url('members/saveNewEmailTemplate');?>",
										        type: "POST",
										        data:  {type:'0',subject:subject,content:content},
											}).done(function(data){
												$.ajax({
											        url: "<?php echo base_url('members/sendTextEmail');?>",
											        type: "POST",
											        data:  ''
												}).done(function(data){
												    $('#panel-body').html( data );
												});
											});
										}else{
											content = tinymce.activeEditor.getContent();
											$.ajax({
										        url: "<?php echo base_url('members/saveNewEmailTemplate');?>",
										        type: "POST",
										        data:  {type:'1',subject:subject,content:content},
											}).done(function(data){
												$.ajax({
											        url: "<?php echo base_url('members/sendHtmlEmail');?>",
											        type: "POST",
											        data:  ''
												}).done(function(data){
												    $('#panel-body').html( data );
												    setup();
												});
											});
										 }
									}else{
										alert('Please fill out email subject');
									}
								}
						    </script>
						    <label class="radio-inline" for="radios-0">
						      <input type="radio" name="email-type" id="radios-0" value="text" checked="checked"> Text Email
						    </label>
						    <label class="radio-inline" for="radios-1">
						      <input type="radio" name="email-type" id="radios-1" value="html"> HTML Email
						    </label>
						  </div>
						  	<input type="submit" class="btn btn-success pull-right email-send-button"  value="Send" role="button">
						  	<a class="btn btn-primary pull-right email-send-button" onclick="saveNewTemplate();return false;" role="button"><span class="fa fa-floppy-o"></span> Save Template</a>
							<a href="<?php echo base_url('members/index')?>"class="btn btn-default pull-right email-send-button" role="button"><span class="fa fa-reply"></span> Cancel</a>
						</div><br/><br/>
						<div class="form-group">
						  <label class="col-md-2 control-label" for="textinput">Subject</label>
						  <div class="col-md-4">
						 	 <input id="subject" name="subject" type="text" placeholder="Email subject" class="form-control input-md">
						  </div>
						  <a href="<?php echo base_url('members/getUsersSelectedToEmail')?> "   class="btn btn-default  pull-right email-send-button showUsers" role="button"><span class="fa fa-users"></span> Show Chosen Users</a>
						</div>
					</form>
				</div>
				<div class="panel-body" id="panel-body">
					<div class="form-group">
					  <label class="col-md-2 control-label" for="textarea">Email Content<br/><small class="gray-text">{name} will be replaced with member name and surname.</small></label>


					  <div class="col-md-10">
					    <textarea class="form-control" id="emailcontent" name="emailcontent" rows="20">Write new email or load email template form underneath...</textarea>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-2 control-label" for="textarea">Templates</label>
					  <div class="col-md-10">
						 <table class="table table-striped table-bordered table-condensed table-hover" id="template-table">
							<thead>
								<tr>
									<th>Template Name</th>
									<th>Last Used</th>
									<th>Created Date</th>
									<th>Load template</th>
									<th>Delete Template</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($templates as $template){?>
								<tr>
									<td><?php echo $template->template_name;?></td>
									<td><?php echo $template->last_used;?></td>
									<td><?php echo $template->created;?></td>
									<td>
										<a class="btn btn-success btn-xs" href="#" onclick="loadTextEmailContent(<?php echo $template->id;?>);return false;"><span class="fa fa-arrow-up"></span> Load Template</a>
									</td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="return confirm('This record will be deleted and it cannot be undone! Are you sure you want to do this?') ? deleteEmailTemplate($(this),<?php echo $template->id;?>) : false;" ><span class="fa fa-trash-o"></span> Delete</a>
									</td>
						 		</tr>
							<?php }?>
							</tbody>
						</table>
					  </div>
					</div>
				</div>
				<div class="panel-footer clearfix">
			    </div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>

<div id="targetDiv">
</div>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
	$('a.showUsers').click(function(){   //bind handlers
	   var url = $(this).attr('href');
	   showDialog(url);

	   return false;
	});

	$("#targetDiv").dialog({  //create dialog, but keep it closed
	   autoOpen: false,
	   height: 600,
	   width: 950,
	   modal: true,
	   open: function(){
           var closeBtn = $('.ui-dialog-titlebar-close');
           closeBtn.append('<span class="ui-button-text">x</span>');
       }
	});

	function showDialog(url){  //load content and open dialog
	    $("#targetDiv").dialog("open");
		$("#targetDiv").dialog( "option", "title", "Members data" );
		$("#targetDiv").load(url);
	}

});
</script>
