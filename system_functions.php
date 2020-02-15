<?php
include 'system_link.php';
session_start();
function import_icons(){
	echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
}
function import_jquery(){
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
}
function import_bootstrap(){
	echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
	echo '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>';
	echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>';
}
function import_custom_css(){
	echo '<link href="cone_style.css" rel="stylesheet"/>';
}
function import_custom_js(){
	echo '<script src="system.js"></script>';
}
function head_navbar($db, $select_this_page){
	$user_id=@$_SESSION['user_id'];
	if(empty($user_id)){
		$get_no_login_menu=$db -> prepare("SELECT menu_name,menu_page_link
		FROM beam_menu_order
		LEFT JOIN beam_menu ON beam_menu.menu_id=beam_menu_order.menu_id
		WHERE beam_menu_order.without_login=1
		AND  beam_menu.without_login=1
		AND  beam_menu.is_active=1
		ORDER BY order_id ASC");
		$get_no_login_menu->execute();
		$result = $get_no_login_menu->get_result();
		$db_menu_by_role = $result->fetch_all(MYSQLI_ASSOC);
		$get_no_login_menu->close();
		$enable_log_out=false;
	}else{
		$role_id=$_SESSION['role_id'];
		$get_menu_by_login=$db -> prepare("SELECT menu_name,menu_page_link
		FROM beam_menu_order		
		LEFT JOIN beam_menu ON beam_menu.menu_id=beam_menu_order.menu_id
		WHERE 
		beam_menu.is_active=1
		AND beam_menu_order.role_id=?
		ORDER BY order_id ASC");
		$get_menu_by_login->bind_param("i",$role_id);
		$get_menu_by_login->execute();
		$result = $get_menu_by_login->get_result();
		$db_menu_by_role = $result->fetch_all(MYSQLI_ASSOC);
		$get_menu_by_login->close();
		
		$enable_log_out=true;
	}
	
	echo "<nav class='navbar navbar-expand-lg navbar-dark' style='background-color:#7395ae'>";
		echo "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo03'";
		echo "aria-controls='navbarTogglerDemo03' aria-expanded='false' aria-label='Toggle navigation'>";
			echo "<span class='navbar-toggler-icon'></span>";
		echo "</button>";
		echo "<a class='navbar-brand' href='#'>Beam Bro Rentals</a>";
		echo "<div class='collapse navbar-collapse' id='navbarTogglerDemo03'>";
			echo "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";	
			foreach($db_menu_by_role AS $key => $menu_data){
				$menu_name=$db_menu_by_role[$key]['menu_name'];
				$menu_page_link=$db_menu_by_role[$key]['menu_page_link'];
				if($select_this_page==$menu_page_link){
					$active="active";
				}else{
					$active="";
				}
				echo "<li class='nav-item $active'>";
					echo "<a class='nav-link' href='$menu_page_link.php' >$menu_name</a>";
				echo "</li>";
			}
			echo "</ul>";
			if($enable_log_out){
				echo "<div class='float-right'>";
					echo "<button class='btn btn-danger' onclick='logout()'> Logout </button>";
				echo "</div>";
			}			
		echo " </div>";
	echo "</nav>";	
}
?>