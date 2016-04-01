<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Images &amp; Videos</h1>
		</div>
	</div>
	<?php //var_dump($rec) ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-body">
				</div>
				<class="panel-footer">
			        <form method="post" action="" id="images_update">
						<div class="error" id="error_header_uploader" style="display:none;"></div>
						<input id="id" name="id" type="hidden" value="<?php echo( isset($rec) ? $rec->id : '' )  ?>" class="btn btn-success btn-xs"/><br/><br/>
			            <table class="table table-striped table-bordered table-condensed table-hover">
			                <tr>
			                    <td>
			                    	<label>Image file</label>
			                    	<input id="image" name="image" type="file" class="btn btn-success btn-xs"/><br/><br/>
									<img width="320" height="240" id="temp_image" src="<?php echo( isset($rec) ? $rec->url_path_thumb : '' )  ?>">
								</td>
								<td>
									<label>Video file</label>
									<input id="video" name="video" type="file" class="btn btn-success btn-xs"/><br/><br/>
									<video id="temp_video" width="320" height="240"  autoplay="autoplay" controls>
										<source id="video_src" src="<?php echo( isset($rec) ? $rec->url_path_main : '' )  ?>" type="video/mp4">
										Your browser does not support the video tag.
									</video>
								</td>
								<td>
									<label>Text overlay</label><br/>
									<input id="overlay_textet" name="overlay_textet" value="<?php echo( isset($rec) ? $rec->overlay_text : '' )  ?>" type="text" class="btn btn-success btn-xs"/><br/>
									<label>URL</label><br/>
									<input id="url" name="url" type="text" value="<?php echo( isset($rec) ? $rec->url : '' )  ?>" class="btn btn-success btn-xs"/><br/>
			                    	<label>Assets for</label><br/>
			                    	<select name="upload_type" id="upload_type" class="btn btn-success btn-xs">
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" value="0" disabled>Please select</option>

										<optgroup label="General Pages">
											<option imgurl1="<?php echo(base_url('/images/mobile_home.png')) ?>" <?php echo( isset($rec) ? (($rec->is_home == 1)? ' selected' : '' ) : '' ) ?> value="is_home" >Home</option>
										</optgroup>
										<optgroup label="49's">
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_latest.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_last == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_last" >49's Latest Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_previous.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_prev" >49's Previous Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_luckydip.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_lucky_dip == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_lucky_dip" >49's Lucky Dip</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_howtoplay.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_how_to_play" >49's How to Play</option>
										</optgroup>
										<optgroup label="Irish Lotto Bet">
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_latest.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_last == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_last" >ILB Latest Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_previous.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_prev" >ILB Previous Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_luckydip.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_lucky_dip == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_lucky_dip" >ILB Lucky Dip</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_howtoplay.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_how_to_play" >ILB How to Play</option>
										</optgroup>
										<optgroup label="Virtual Horse Racing">
											<option imgurl1="<?php echo(base_url('/images/mobile_vhr_latest.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_last == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_last" >VHR Latest Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vhr_previous.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_prev" >VHR Previous Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vhr_howtoplay.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_how_to_play" >VHR How to Play</option>
										</optgroup>
										<optgroup label="Virtual Greyhound Racing">
											<option imgurl1="<?php echo(base_url('/images/mobile_vgr_latest.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_last == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_last" >VGR Latest Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vgr_previous.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_prev" >VGR Previous results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vgr_howtoplay.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_how_to_play" >VGR How to Play</option>
										</optgroup>
										<optgroup label="Rapido">
											<option imgurl1="<?php echo(base_url('/images/mobile_rapido_latest.png')) ?>" <?php echo( isset($rec) ? (($rec->is_rapido_last == 1)? ' selected' : '' ) : '' ) ?> value="is_rapido_last" >Rapido Latest Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_rapido_previous.png')) ?>" <?php echo( isset($rec) ? (($rec->is_rapido_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_rapido_prev" >Rapido Previous Results</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_rapido_howtoplay.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play" >Rapido How to Play</option>
										</optgroup>
										<optgroup label="Backgrounds">
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_howtoplay_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_49s == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_49s" >49's How to Play Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_49s_luckydip_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_49s == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_49s" >49's Lucky Dip Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_howtoplay_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_ilb == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_ilb" >ILB How to Play Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_ilb_luckydip_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_ilb == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_ilb" >ILB Lucky Dip Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vhr_howtoplay_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_vhr == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_vhr" >VHR How to Play Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_vgr_howtoplay_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_vgr == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_vgr" >VGR How to Play Background</option>
											<option imgurl1="<?php echo(base_url('/images/mobile_rapido_howtoplay_bg.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_ra == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_ra" >Rapido How to Play Background</option>
										</optgroup>

									</select>
									<br/>
									<br/>
	  							<a id="img_url_href_1" href="" class="fancybox" rel="group"  style="width: 240px;height: 160px;">
										<img title="eee" alt="Section thumbnail" id="img_url_1" style="max-width: 240px;max-height: 300px;">
									</a>
			                    </td>
			                </tr>
			            </table>
		  			<script>

							$(function() {

								$(".fancybox").fancybox();

								$( "#upload_type" ).change(function() {
									$('#img_url_1').attr('src',$( "#upload_type option:selected" ).attr('imgurl1'));
									$('#img_url_href_1').attr('href',$( "#upload_type option:selected" ).attr('imgurl1'));
									//$('#img_url_2').attr('src',$( "#upload_type option:selected" ).attr('imgurl2'));
									//$('#img_url_href_2').attr('href',$( "#upload_type option:selected" ).attr('imgurl2'));
									//$('#img_url_3').attr('src',$( "#upload_type option:selected" ).attr('imgurl3'));
									//$('#img_url_href_3').attr('href',$( "#upload_type option:selected" ).attr('imgurl3'));
								}).change();
							});

						</script>
						<div class="col-xs-12">
			            	<input type="submit" id="update_submit" class="btn btn-primary pull-right" role="button" value="Save"/><br/><br/>
			            	<input type="hidden" name="upload_type" value="home_slider" />
			            	</div>
			        </form>
                	<div class="clearfix"></div>
                </div>
			</div>
		</div>
	</div>
</div>




			<script>
                $(document).ready(function() {

					$("#image").change(function(event) {
                        event.preventDefault();
                        //alert( "Handler for .submit() called." );
                        postImage();
                    });
                    $("#video").change(function(event) {
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
							id: $( "#id" ).val(),
							type: $( "#upload_type" ).val()
                        })
                        .done(function(data) {
                                if(data.server_obj.success == true){
                                    $("#temp_image").attr('src',data.body);
                                    //$("#update_submit").show();
                                    $("#error_header_uploader").hide();
                                    window.location = '<?php echo(base_url('uploadsmobile')) ?>';
                                } else {
                                    $("#error_header_uploader").hide();
                                    $("#error_header_uploader").show();
                                    $("#error_header_uploader").html(data.server_obj.error_msg);
                                    //$("#update_submit").hide();
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
                                //$("#update_submit").show();
                            } else {
                                $("#error_header_uploader").hide();
                                $("#error_header_uploader").show();
                                $("#error_header_uploader").html(data.server_obj.error_msg.error);
                                //$("#update_submit").hide();
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

                                //$("#update_submit").show();
                                $("#error_header_uploader").hide();
                            } else {
                                $("#error_header_uploader").hide();
                                $("#error_header_uploader").show();
                                $("#error_header_uploader").html(data.server_obj.error_msg.error);
                                //$("#update_submit").hide();
                            }
                        }
                    });
                }
            </script>
