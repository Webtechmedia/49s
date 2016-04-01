<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header">Reports</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">

				<div class="panel-body">
					<table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th>Statistics</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Members Statistics</td>
								<td>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/users') ?>" id="user_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
								</td>
							</tr>
							<tr>
								<td>Greyhound Racing Statistics</td>
								<td>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/dog') ?>" id="49_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
								</td>
							</tr>
                            <tr>
                                <td>Horse Racing Statistics</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/horse') ?>" id="horse_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>49s Statistics</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/draw_49') ?>" id="49_draw_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>ILB Statistics</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/draw_ILB') ?>" id="ilb_draw_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rapido Statistics</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/draw_rapido') ?>" id="rapido_draw_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Daily Numbers</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/draw_daily') ?>" id="daily_draw_statistic_link"  role="button"><span class="fa fa-eye"></span> View</a>
                                </td>
                            </tr>
						</tbody>
					</table>
                    <table class="table table-striped table-bordered table-condensed table-hover" id="members-table">
						<thead>
							<tr>
								<th>Competitions</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                            <td>Miss Smiley Dec 2015 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td> <a class="btn btn-success btn-xs" href="<?php echo base_url('index.php/reports/miss') ?>" id="rapido_draw_statistic_link_new"  role="button"><span class="fa fa-eye"></span> View</a></td>
                            </tr>
                            </tbody>
                            </table>
				</div>
			</div>
		</div>
	</div>
    <div id="report_dialog" title="Basic dialog"></div>
    <script>
        $(document).ready(function () {
            var dialog_report = $( "#report_dialog" ).dialog({  //create dialog, but keep it closed
                autoOpen: false,
                height: 600,
                width: 950,
                modal: true,
         	    open: function(){
                   var closeBtn = $('.ui-dialog-titlebar-close');
                   $('.ui-button-text').remove();
                   closeBtn.append('<span class="ui-button-text">x</span>');
               }
            });

            $('#user_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"Members Statistics");
                return false;
            });

            $('#49_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"Virtual Greyhound Racing Statistics");
                return false;
            });

            $('#horse_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"Virtual Horse Racing Statistics");
                return false;
            });

            $('#49_draw_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"49s Statistics");
                return false;
            });

            $('#ilb_draw_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"ILB Statistics");
                return false;
            });

            $('#rapido_draw_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"Rapido Statistics");
                return false;
            });

            $('#daily_draw_statistic_link').click(function () {
                showReportDialog($(this).attr('href'),"Daily Statistics");
                return false;
            });
            $('#rapido_draw_statistic_link_new').click(function () {
                showReportDialog($(this).attr('href'),"Miss Smiley Dec 2015");
                return false;
            });
            function showReportDialog(url,title){  //load content and open dialog
                $(dialog_report).dialog('option', "title",title);
                $(dialog_report).dialog("open");
                $(dialog_report).load(url);
            }

        });

    </script>
</div>
