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
		<?php head_navbar($db,'pricing'); ?>
		<div class='container '>
			<div class='row'>
				<div class='col'>
					<table class='mt-3 table table-striped table-border table-primary text-center'>
						<tr>
							<th>Service</th>
							<th>Time</th>
							<th>Cost</th>
							<th>Savings</th>
						</tr>
						<tr>
							<td>Snow Cone Machine Rental</td>
							<td>24 hours</td>
							<td>$50</td>		
							<td></td>							
						</tr>
						<tr>
							<td>Snow Cone Machine Rental</td>
							<td>48 hours</td>
							<td>$90</td>		
							<td>10%</td>							
						</tr>
						<tr>
							<td>Snow Cone Machine Rental</td>
							<td>1 Week</td>
							<td>$300</td>		
							<td>14%</td>							
						</tr>
						<tr>
							<td>Snow Cone Machine Rental</td>
							<td>> 1 Week</td>
							<td><a href='contact.php'>Contact Us</a></td>		
							<td><a href='contact.php'>Contact Us</a></td>							
						</tr>					
					</table>
						
				</div>
				<div class='col'>
				<table class='mt-3 table table-striped table-border table-primary text-center'>
						<tr>
							<th colspan='99' class='text-center'>Take Over Our Business</th>													
						</tr>
						<tr>
							<td>Buy Snow Cone Machine</td>
							<td>Ownership of Machine</td>
							<td colspan='2'>$800</td>		
													
						</tr>
						<tr>
							<td>Buy Snow Cone Webpage</td>
							<td>Ownership of Webpage</td>
							<td colspan='2'>$1000</td>		
						</tr>
						<tr>
							<td>Buy Our Stress</td>
							<td>Ownership of Webpage <br>and Machine</td>
							<td colspan='2'>$1600</td>			
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>

</html>