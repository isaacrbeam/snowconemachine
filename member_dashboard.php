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
	</head>
	<body>
	<?php 	head_navbar($db,'member_dashboard') ?>
		<div class='container'>
			<div class='row h-75'>
				<div class='m-3 p-3 col rounded  transparent_white_bg'>
					<div class='row'>
						<div class='mt-2 col-md-4 col-sm-12'>
						<button class='btn btn-outline-primary btn-block'>Schedule Reservation</button>
						</div>
						<div class='mt-2 col-md-4 col-sm-12'>
						<button class='btn btn-primary btn-block'>My Reservations</button>
						</div>
						<div class='mt-2 col-md-4 col-sm-12'>
						<button class='btn btn-outline-primary btn-block'>My Profile</button>
						</div>
					</div>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					  
					  </div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
					  
					  </div>
					  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
					  
					  </div>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>