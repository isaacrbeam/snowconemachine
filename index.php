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
		<script>
			$(document).ready(function(){
				bind_buttons();
			});
			function bind_buttons(){
				$("#request_login").click(function(){
					request_login();
				});
			}
			function request_login(){
				var email=$('#email').val();
				var password=$('#password').val();
				$.post("index_ajax.php", {
					method:"POST",
					method_type:"request_login",
					email:email,
					password:password
				},function(login_flags){
					var jsonData_array=JSON.parse(login_flags);
					console.log(jsonData_array);
					if(jsonData_array[0]==0){
						login_request_denied();
					}else if(jsonData_array[0]==1){
						window.location.replace(jsonData_array[1]);
					}
					
				});
			}
			function login_request_denied(){
				$("#email").addClass('border-danger').val('');
				$("#password").addClass('border-danger').val('');
				$("#error_message").text('Invalid Username or Password');
			}
		</script>
	</head>
	<body>
	<?php head_navbar($db,'index') ?>
		<div class='container-fluid '>
		
			<div class='mt-3 col-lg-3 col-md-6 col-sm-12'>
				<div class="card transparent_bg">
				<!-- style="background-color:#7abaff" -->
					<div class="card-body">
						
							<label>Email</label>
							<input class='form-control' type='text' name='email' id='email' autocomplete="off"/>
							<label>Password</label>
							<input class='form-control' type='password' id='password' autocomplete="off"/>
							<button class='mt-3 btn btn-block btn-outline-primary' onclick='request_login();'>Login</button>
							<div id='error_message' class=' text-center text-danger'>
							
							</div>
							<div class='mt-2 text-center'>
								<a href='create_account.php'>Create Account</a>
							</div>
						
					</div>
				</div>
			</div>
		</div>
	</body>

</html>