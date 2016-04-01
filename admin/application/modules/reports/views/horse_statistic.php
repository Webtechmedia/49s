<div class="panel panel-default">
	<div class="panel-body">
  		<table class="table table-striped table-bordered table-condensed ">
			<tbody>
				<tr>
					<td>
			            <input id="port" type="checkbox" > PORTMAN PARK<br/>
			            <input id="sprint" type="checkbox" > SPRINTVALLEY<br/>
			            <input id="steep" type="checkbox" > STEEPLEDOWNS<br/>
				 	</td>
				 	<td>
			            <input id="from" type="date" value="<?php echo date('Y-m-d'); ?>"> from<br/>
			            <input id="to" type="date" value="<?php echo date('Y-m-d'); ?>"> to<br/>
				 	</td>
				 	<td>
						<a href="#" class="btn btn-success" onclick="horsesearch(); return false;" >Show</a>
						<a id="downloadHorsesXML" class="btn btn-success pull-right" href="#">Download</a>
				 	</td>
				</tr>
			</tbody>
		</table>
            <script>
                function horsesearch(){
                    var jqxhr = $.ajax(
                        {
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            url: "<?php echo base_url('index.php/reports/horse_statistic_data') ?>",
                            data: '{"portman_park":"' + $("#port").prop('checked') +
                                '","sprintvalley":"' + $("#sprint").prop('checked') +
                                '","steepledowns":"' + $("#steep").prop('checked') +
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
          
                $( "#downloadHorsesXML" ).click(function( event ) {
                    event.preventDefault();
            		$.ajax({
            			url: '<?php echo base_url("index.php/reports/vhr_race_download") ?>',
            			type: 'post',
            			dataType: 'html',
            			data:  'portman_park=' + $("#port").prop('checked') +'&sprintvalley=' + $("#sprint").prop('checked') +'&steepledowns=' + $("#steep").prop('checked') +'&from='+ $("#from").val() +'&to='+ $("#to").val() +'',
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




