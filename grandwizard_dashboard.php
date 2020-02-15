<?php
include 'system_functions.php';
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php
		import_jquery();
		import_bootstrap();
		import_custom_css();
		import_custom_js();
		?>
		<script src="grandmaster_dashboard_script.js"></script>
	</head>
	<body>
	<?php 	head_navbar($db,'grandwizard_dashboard') ?>
		<div class='container'>
			<div class='row h-75'>
				<div class='m-3 p-3 col rounded  transparent_white_bg'>				
					<div class='row'>
						<div class='mt-2 col-md-4 col-sm-12'>
							<button class='btn btn-outline-primary btn-block dashboard_btn active' id='active_rev_btn'>Active Reservations</button>
						</div>
						<div class='mt-2 col-md-4 col-sm-12'>
							<button class='btn btn-outline-primary btn-block dashboard_btn' id='pending_rev_btn'>Pending Reservations</button>
						</div>
						<div class='mt-2 col-md-4 col-sm-12'>
							<button class='btn btn-outline-primary btn-block dashboard_btn' id='admin_tools_btn'>Administration</button>
						</div>
					</div>
					<div class="tab-content">
					  <div class="tab-pane dashboard active" id="active_rev">
						
					  </div>
					  <div class="tab-pane dashboard" id="pending_rev">
					  
					  </div>
					  <div class="tab-pane dashboard" id="admin_tools">
					  
					  </div>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>