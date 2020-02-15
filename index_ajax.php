<?php
include 'system_functions.php';

function log_invalid_login($db,$email){
	$http_x=getenv('HTTP_X_FORWARDED_FOR');
	$remote_addr=getenv('REMOTE_ADDR');
	$check_login=$db -> prepare("INSERT INTO beam_incorrect_login SET email=?, HTTP_X=?, REMOTE_ADDR=?, log_date=NOW()");
	$check_login->bind_param("sss",$email,$http_x,$remote_addr);
	$check_login->execute();
	$check_login->close();
}

function validate_request_login($db){
	
	$email=$_POST['email'];
	$password=$_POST['password'];

	$pass_hashed=md5($password);
	$check_login=$db -> prepare("SELECT beam_user.user_id,
	beam_user.f_name,
	beam_user.l_name,
	beam_role.login_page,
	beam_role.role_id
	FROM beam_user
	INNER JOIN beam_role_user ON beam_role_user.user_id=beam_user.user_id
	INNER JOIN beam_role ON beam_role.role_id=beam_role_user.user_role_id
	WHERE beam_user.email=? 
	AND beam_user.pass_hashed=?");
	$check_login->bind_param("si",$email,$pass_hashed);
	$check_login->execute();
	$result = $check_login->get_result();
	$allRows = $result->fetch_all(MYSQLI_ASSOC);
	$check_login->close();
	if(count($allRows)>0){
		// Session variables here
		//error_log(print_r($allRows,true));
		$_SESSION['user_id']=$allRows[0]['user_id'];
		$_SESSION['role_id']=$allRows[0]['role_id'];
		$_SESSION['f_name']=$allRows[0]['f_name'];
		$_SESSION['l_name']=$allRows[0]['l_name'];
		$login_page=$allRows[0]['login_page'].".php";
		$json_action_array=array(1,$login_page);
		echo json_encode($json_action_array);
	}else{
		log_invalid_login($db,$email);
		echo json_encode(array(0,0));
	}
}


$method=@$_POST['method_type'];
if($method=='request_login'){
	validate_request_login($db);
}else{
	echo "NOPE$method";
}

?>