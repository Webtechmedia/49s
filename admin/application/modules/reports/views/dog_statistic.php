<div class="panel panel-default">
	<div class="panel-body">
  		<table class="table table-striped table-bordered table-condensed ">
			<tbody>
				<tr>
					<td>
  		    			<input id="brush" type="checkbox" > BRUSHWOOD<br/>
           				<input id="mill" type="checkbox" > MILLERSFIELD<br/>
				 	</td>
				 	<td>
 						<input id="from" type="date" value="<?php echo date('Y-m-d'); ?>"> from<br/>
            			<input id="to" type="date" value="<?php echo date('Y-m-d'); ?>"> to<br/>
				 	</td>
				 	<td>
				 		<a href="#" class="btn btn-success  " onclick="dogsearch(); return false;" >Show</a>
				 		<a id="downloadDogsXML" class="btn btn-success pull-right"  href="#">Download</a>
				 	</td>
				</tr>
			</tbody>
		</table>

            <script>
                function dogsearch(){
                    var jqxhr = $.ajax(
                        {
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            url: "<?php echo base_url('index.php/reports/dog_statistic_data') ?>",
                            data: '{"brush":"' + $("#brush").prop('checked') +
                            '","mill":"' + $("#mill").prop('checked') +
                            '","from":"' + $("#from").val() +
                            '","to":"' + $("#to").val() +
                            '"}'
                        })
                        .done(function(result) {
                            //alert( "success" );
                            $("#data_cont").html(result);
                        })
                        .fail(function() {
                            //alert( "error" );
                        })
                        .always(function() {
                            //alert( "complete" );
                        });
                    return false;
                }
                $( "#downloadDogsXML" ).click(function( event ) {
                    event.preventDefault();
            		$.ajax({
            			url: '<?php echo base_url("index.php/reports/vgr_race_download") ?>',
            			type: 'post',
            			dataType: 'html',
            			data:  'brush=' + $("#brush").prop('checked') +'&mill=' + $("#mill").prop('checked') +'&from='+ $("#from").val() +'&to='+ $("#to").val() +'',
            			beforeSend: function() {
            			},
            			complete: function() {
            			},
            			success: function(html) {
							window.location.href = html;
            			},
            			error: function(){
            				alert('Connection error! Please try again.');
            			}
            		});

                });
            </script>
  	</div>
  	<div class="panel-footer clearfix">
         <div id="downrame">
            <div id="data_cont">
            </div>
           	
        </div>
  	</div>
</div>










