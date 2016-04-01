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

				<?php //print_r($this->session->all_userdata());?>


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
			                            	<option imgurl1="<?php echo(base_url('/images/homeHero.png')) ?>" <?php echo( isset($rec) ? (($rec->is_home == 1)? ' selected' : '' ) : '' ) ?> value="is_home" >Home</option>
			                            	<option imgurl1="<?php echo(base_url('/images/fountBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_oracle == 1)? ' selected' : '' ) : '' ) ?> value="is_oracle" >The Fount</option>
			                            	<option imgurl1="<?php echo(base_url('/images/Shareholders.png')) ?>" <?php echo( isset($rec) ? (($rec->is_bet_here == 1)? ' selected' : '' ) : '' ) ?> value="is_bet_here" >Bet Here</option>
			                            	<option imgurl1="<?php echo(base_url('/images/gambleawareBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_responsible == 1)? ' selected' : '' ) : '' ) ?> value="is_responsible" >Responsible Gambling</option>
											<option imgurl1="<?php echo(base_url('/images/mobileBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_mobile == 1)? ' selected' : '' ) : '' ) ?> value="is_mobile" >Mobile App</option>
										</optgroup>
										<optgroup label="49's">
				                            <option imgurl1="<?php echo(base_url('/images/49shomeBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_last == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_last" >49's Latest Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/49spreviousBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_prev" >49's Previous Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/49shotcoldBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_h_c == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_h_c" >49's Hot & Cold</option>
				                            <option imgurl1="<?php echo(base_url('/images/49sluckyBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_lucky_dip == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_lucky_dip" >49's Lucky Dip</option>
				                            <option imgurl1="<?php echo(base_url('/images/49ssyndicateBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_syndicates == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_syndicates" >49's Syndicates</option>
				                            <option imgurl1="<?php echo(base_url('/images/49spresenterHero.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_winner == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_winner" >49's Presenters</option>
				                            <option imgurl1="<?php echo(base_url('/images/49showtoBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_how_to_play" >49's How to Play</option>
				                            <option imgurl1="<?php echo(base_url('/images/49sRulesBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_49s_rule == 1)? ' selected' : '' ) : '' ) ?> value="is_49s_rule" >49's Rules</option>
										</optgroup>
										<optgroup label="Irish Lotto Bet">
				                            <option imgurl1="<?php echo(base_url('/images/ILBhomeBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_last == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_last" >ILB Latest Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBpreviousBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_prev" >ILB Previous Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBhotcoldBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_h_c == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_h_c" >ILB Hot & Cold</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBluckyBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_lucky_dip == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_lucky_dip" >ILB Lucky Dip</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBsyndicateBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_syndicates == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_syndicates" >ILB Syndicates</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBhowtoBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_how_to_play" >ILB How to Play</option>
				                            <option imgurl1="<?php echo(base_url('/images/ILBRulesBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_ilb_rule == 1)? ' selected' : '' ) : '' ) ?> value="is_ilb_rule" >ILB Rules</option>
										</optgroup>
										<optgroup label="Virtual Horse Racing">
				                            <option imgurl1="<?php echo(base_url('/images/VHRhomeBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_last == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_last" >VHR Latest Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/VHRpreviousBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_prev" >VHR Previous Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/VHRhowtoBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_how_to_play" >VHR How to Play</option>
				                            <option imgurl1="<?php echo(base_url('/images/VHRRulesBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vhr_rule == 1)? ' selected' : '' ) : '' ) ?> value="is_vhr_rule" >VHR Rules</option>
										</optgroup>
										<optgroup label="Virtual Greyhound Racing">
				                            <option imgurl1="<?php echo(base_url('/images/VGRhomeBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_last == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_last" >VGR Latest Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/VGRpreviousBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_prev" >VGR Previous Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/VGRhowtoBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_how_to_play" >VGR How to Play</option>
				                            <option imgurl1="<?php echo(base_url('/images/vgrRulesBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_vdr_rule == 1)? ' selected' : '' ) : '' ) ?> value="is_vdr_rule" >VGR Rules</option>
										</optgroup>
										<optgroup label="Rapido">
				                            <option imgurl1="<?php echo(base_url('/images/RapidohomeBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_rapido_last == 1)? ' selected' : '' ) : '' ) ?> value="is_rapido_last" >Rapido Latest Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/RapidopreviousBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_rapido_prev == 1)? ' selected' : '' ) : '' ) ?> value="is_rapido_prev" >Rapido Previous Results</option>
				                            <option imgurl1="<?php echo(base_url('/images/RapidohowtoBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play" >Rapido How to Play</option>
											<option imgurl1="<?php echo(base_url('/images/RapidoRulesBanner.png')) ?>" <?php echo( isset($rec) ? (($rec->is_rapido_rule == 1)? ' selected' : '' ) : '' ) ?> value="is_rapido_rule" >Rapido Rules</option>
										</optgroup>
										<optgroup label="Promo Images">
											<option imgurl1="<?php echo(base_url('/images/promo_home.png')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_home == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_home" >Promo Home</option>

											<option imgurl1="<?php echo(base_url('/images/promo_49.png')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_49_latest   == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_49_latest" >Promo 49's Latest Results</option>

											<option imgurl1="<?php echo(base_url('/images/promo_irish.png')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_ilb_latest == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_ilb_latest" >Promo ILB Latest Results</option>

											<option imgurl1="<?php echo(base_url('/images/promo_VHR.png')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_vhr_latest == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_vhr_latest" >Promo VHR Latest Results</option>

											<option imgurl1="<?php echo(base_url('/images/promo_VGR.PNG')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_vgr_latest == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_vgr_latest" >Promo VGR Latest Results</option>

											<option imgurl1="<?php echo(base_url('/images/promo_rapido.png')) ?>" <?php echo( isset($rec) ? (($rec->is_promo_rapido_latest == 1)? ' selected' : '' ) : '' ) ?> value="is_promo_rapido_latest" >Promo Rapido Latest Results</option>
										</optgroup>
										<!--
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_49s == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_49s" >How to play bgr 49s</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_49s == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_49s" >Lucky dip bgr 49s</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_ilb == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_ilb" >How to play bgr ilb</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_ilb == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_ilb" >Lucky dip bgr ilb</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_ra == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_ra" >How to play bgr ra</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_ra == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_ra" >Lucky dip bgr ra</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_vhr == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_vhr" >How to play bgr vhr</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_vhr == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_vhr" >Lucky dip bgr vhr</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_how_to_play_bgr_vgr == 1)? ' selected' : '' ) : '' ) ?> value="is_how_to_play_bgr_vgr" >How to play bgr vgr</option>
										<option imgurl1="<?php echo(base_url('/images/49slogo.png')) ?>" <?php echo( isset($rec) ? (($rec->is_lucky_dip_bgr_vgr == 1)? ' selected' : '' ) : '' ) ?> value="is_lucky_dip_bgr_vgr" >Lucky dip bgr vgr</option>
										-->

									</select>
									<br/>
									<br/>
									<a id="img_url_href_1" href="" class="fancybox" rel="group"  style="width: 240px;height: 160px;">
										<img title="eee" alt="ssss" id="img_url_1" style="max-width: 240px;max-height: 160px;">
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




<script src="<?php echo base_url("/js/abigimage.jquery.min.js") ?>"></script>
			<script>
                $(document).ready(function() {
					$('.myimgclass').abigimage();

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
                        var jqxhr = $.post( "<?php echo base_url('/uploads/save_image_video' ) ?>", {
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
                                    window.location = '<?php echo(base_url('uploads')) ?>';
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
                        url: "<?php echo base_url('/uploads/prepare_image')  ?>",
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
                        url: "<?php echo base_url('/uploads/prepare_video') ?>",
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
