function logout(){
	$.post("logout.php", {
		method:"POST",
	},function(login_flags){
		window.location.replace('index.php');
	});
}