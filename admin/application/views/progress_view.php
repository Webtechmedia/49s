<?php //phpinfo(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<meta name="author" content="red7mobile">
	<meta name="robots" content="noindex, nofollow">
	<title><?php if(isset($title)){echo $title;} ?></title>

	<link href="<?php echo base_url("css/bootstrap.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("css/styles.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("css/font-awesome.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("css/jquery-ui.min.css") ?>" rel="stylesheet">
	<link href="<?php echo base_url("css/msg_styles.css") ?>" rel="stylesheet">

	<script src="<?php echo base_url("js/jquery.min.js") ?>"></script>
	<script src="<?php echo base_url("js/jquery-ui.min.js") ?>"></script>
	<script src="<?php echo base_url("js/bootstrap.min.js") ?>"></script>
	<script src="<?php echo base_url("js/site.js") ?>"></script>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}

	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Database Importer</h1>
	<div id="body">
		<p>Cleanup files.   <a href="<?php echo(base_url('/importer/index') ) ?>" target="_blank">Clean files</a></p>
		<code>
			 Upload files to admin/importer_files/files.<br/>
			 output will be uploaded to admin/importer_files/cleaned.
		</code>
	</div>
	<div id="body">
		<p>Step one imports number games data.  Run import step 1: <a href="<?php echo(base_url('/importer/process_1') ) ?>" target="_blank">Run step 1</a></p>
		<code>
			<button id="readfile">Show step 1 progress</button>
			<div id="results" style="float:right;"></div>
		</code>
		<script>
		$( "#readfile" ).click(function() {
 			$.ajax({
				url: '<?php echo(base_url('/importer/get_progress') ) ?>',
				type: 'post',
				dataType: 'html',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function(data){
					$('#results').html(data);
				},
				error: function(){
					alert('Connection error! Please try again.');
				}
			});
		});
		</script>
	</div>
	<div id="body">
		<p>Step two imports event type, meetings and events for virtual horses :    Run import step 2: <a href="<?php echo(base_url('/importer/process_2') ) ?>" target="_blank">Run step 2</a></p>
		<code>
			<button id="readfile2">Show step 2 progress</button>
			<div id="results2" style="float:right;"></div>
		</code>
		<script>
		$( "#readfile2" ).click(function() {
 			$.ajax({
				url: '<?php echo(base_url('/importer/get_progress2') ) ?>',
				type: 'post',
				dataType: 'html',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function(data){
					$('#results2').html(data);
				},
				error: function(){
					alert('Connection error! Please try again.');
				}
			});
		});
		</script>
	</div>



	<div id="body">
		<p>Step three imports virtual horse results, positions, racebets selections and prices :    Run import step 3: <a href="<?php echo(base_url('/importer/process_3') ) ?>" target="_blank">Run step 3</a></p>
		<code>
			<button id="readfile3">Show step 3 progress</button>
			<div id="results3" style="float:right;"></div>
		</code>
		<script>
		$( "#readfile3" ).click(function() {
 			$.ajax({
				url: '<?php echo(base_url('/importer/get_progress3') ) ?>',
				type: 'post',
				dataType: 'html',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function(data){
					$('#results3').html(data);
				},
				error: function(){
					alert('Connection error! Please try again.');
				}
			});
		});
		</script>
	</div>




	<div id="body">
		<p>Step four imports horse races by date:    Run import step 4: <a href="<?php echo(base_url('/importer/process_4') ) ?>" target="_blank">Run step 4</a></p>
		<code>
			<button id="readfile4">Show step 4 progress</button>
			<div id="results4" style="float:right;"></div>
		</code>
		<script>
		$( "#readfile4" ).click(function() {
 			$.ajax({
				url: '<?php echo(base_url('/importer/get_progress4') ) ?>',
				type: 'post',
				dataType: 'html',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function(data){
					$('#results4').html(data);
				},
				error: function(){
					alert('Connection error! Please try again.');
				}
			});
		});
		</script>
	</div>


		<div id="body">
		<p>Step four imports dogs races by date:    Run import step 5: <a href="<?php echo(base_url('/importer/process_5') ) ?>" target="_blank">Run step 5</a></p>
		<code>
			<button id="readfile5">Show step 5 progress</button>
			<div id="results5" style="float:right;"></div>
		</code>
		<script>
		$( "#readfile5" ).click(function() {
 			$.ajax({
				url: '<?php echo(base_url('/importer/get_progress5') ) ?>',
				type: 'post',
				dataType: 'html',
				beforeSend: function() {
				},
				complete: function() {
				},
				success: function(data){
					$('#results5').html(data);
				},
				error: function(){
					alert('Connection error! Please try again.');
				}
			});
		});
		</script>
	</div>




	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>









