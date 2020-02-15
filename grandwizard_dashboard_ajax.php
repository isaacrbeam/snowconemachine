<?php
session_start();
include_once 'system_link.php';
if($_SESSION['role_id']==1){
	function get_active_rev($db){
		$active_rev_array=get_reversations($db,1); //0 pending, 1 approved
		if(count($active_rev_array)>0){	
			echo "<table class='table'>";
				echo "<tr>";
					echo "<td>Reservation ID </td>";
				echo "</tr>";
			foreach($active_rev_array AS $key => $rev_data){
				$rev_id=$rev_data['reservation_id'];
				//$rev_id=$rev_data['reservation_id'];
			}
			echo "</table>";
		}else{
			echo "<table class='table'>";
				echo "<tr>";
					echo "<td>No Active Reservations</td>";
				echo "</tr>";
			echo "</table>";
		}
	}
	
	function get_reversations($db,$approved){
		$get_rev=$db -> prepare("SELECT beam_reservation.* 
		FROM beam_reservation WHERE rev_canceled !=1 AND rev_approved=?");
		$get_rev->bind_param("i",$approved);
		$get_rev->execute();
		$raw_data=$get_rev->get_result();
		$array_of_rev=$raw_data->fetch_all(MYSQLI_ASSOC);
		$get_rev->close();
		return $array_of_rev;
	}
	
	function get_pending_rev($db){
		$pending_rev_array=get_reversations($db,0); //0 pending, 1 approved
		if(count($pending_rev_array)>0){	
			echo "<table class='table'>";
				echo "<tr>";
					echo "<td>Reservation ID </td>";
				echo "</tr>";
			foreach($pending_rev_array AS $key => $rev_data){
				$rev_id=$rev_data['reservation_id'];
				//$rev_id=$rev_data['reservation_id'];
			}
			echo "</table>";
		}else{
			echo "<table class='table'>";
				echo "<tr>";
					echo "<td>No Pending Reservations</td>";
				echo "</tr>";
			echo "</table>";
		}
	}
	
	function get_admin_tools($db){
		echo "<div class='m-3 row'>";
			echo "<div class='col-lg-3 col-md-12' id='admin_menu_1'>";
				echo "<select id='get_tool' class='form-control'>";
					echo "<option value=''>Select Option:</option>";
					echo "<option value='1'>Users</option>";
					echo "<option value='2'>Menus</option>";
					echo "<option value='3'>Roles</option>";
				echo "</select>";
			echo "</div>";
			echo "<div class='col-lg-3 col-md-12' id='admin_menu_2'>";
				
			echo "</div>";
			echo "<div class='col-lg-3 col-md-12' id='admin_menu_3'>";
				
			echo "</div>";
		echo "</div>";
		echo "<div class='m-3 row'>";			
			echo "<div class='col'  id='admin_tool'>";
				
			echo "</div>";
		echo "</div>";
	}
	
	function get_tool_1($db){
		$select_all_user_data=$db->prepare("SELECT beam_user.f_name,
		beam_user.l_name,
		beam_user.creation_date,
		beam_user.active,
		beam_role_user.role_id,
		beam_role_user.auth_date,
		beam_role_user.auth_by,
		beam_role_user.active AS role_active
		FROM beam_user
		LEFT JOIN beam_role_user ON beam_role_user.user_id=beam_user.user_id	
		");
		$select_all_user_data->execute();
		$raw_user_data=$select_all_user_data->get_result();
		$array_of_user_data=$raw_user_data->fetch_all(MYSQLI_ASSOC);
		$select_all_user_data->close();
		if(count($array_of_user_data)>0){
			echo "<table class='table table-border table-striped'>";
				echo "<tr>";
					echo "<td>First Name</td>";
					echo "<td>Last Name</td>";
					echo "<td>Created On</td>";
					echo "<td>Role ID</td>";
					echo "<td>Authorized BY</td>";
					echo "<td>Auth ON</td>";
					echo "<td>Auth Active</td>";
					echo "<td>User Active</td>";
				echo "</tr>";
				foreach($array_of_user_data AS $user){
					echo "<tr>";
						echo "<td>".$user['f_name']."</td>";
						echo "<td>".$user['l_name']."</td>";
						echo "<td>".$user['creation_date']."</td>";
						echo "<td>".$user['role_id']."</td>";						
						echo "<td>".$user['auth_by']."</td>";
						echo "<td>".$user['auth_date']."</td>";
						echo "<td>".$user['role_active']."</td>";		
						echo "<td>".$user['active']."</td>";	
					echo "</tr>";					
				}
				echo "</table>";
		}else{
			echo 'Error: There should be at least one user to view this? What happened?';
		}
	}
	
	function get_tool_2($db){
		echo "tool 2";
	}
	
	function get_tool_3($db){
		echo "tool 3";
	}
	
	$method=$_POST['method'];
	switch ($method){
		case "get_active_rev":
			get_active_rev($db);
			break;
		case "get_pending_rev":
			get_pending_rev($db);
			break;
		case "get_admin_tools":
			get_admin_tools($db);
			break;
		case "get_tool_1":
			get_tool_1($db); // Users
			break;
		case "get_tool_2":
			get_tool_2($db); // Roles
			break;		
		case "get_tool_3":
			get_tool_3($db); // Menus
			break;				
	}
}else{
	header("Location: logout.php");//think about this
}
?>