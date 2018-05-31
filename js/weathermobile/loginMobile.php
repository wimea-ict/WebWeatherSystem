<?php

header("Access-Control-Allow-Origin: *");
header("content-type:application/json");

$link =  mysqli("localhost", "jmuhumuza", "joshua", "mobilewimeadb");

/* check connection */
if (mysqli_connect_errno()) {
   die('{"error": {"code": "004", "message": "Login error! Code: 004"}}'); 
}



$loginData = json_decode(file_get_contents('php://input'),true);//must be there

//$loginData = array('userName' => 'user','password' => 'secret');	



				
$userName =$loginData['userName'];//"Mutesasira";// 
$password =  $loginData['password'];//"jovan";//



$userData = array('id' => '',
				'name' => '',
				'email' => '',
				'password' => '',
				'active' => '');


if(!empty($userName) && !empty($password)){

	//echo($email.'  '.$password);

	$userName = mysqli_real_escape_string($link, $userName);
	$password = mysqli_real_escape_string($link, md5($password));

	$results = mysqli_query($link,"SELECT id, name, email, password, active FROM kibsys_weather WHERE ( email='".$userName."' or name='".$userName."' ) AND password='".$password."' LIMIT 1") or die('{"error":"Login error! Code: 003"}'); 
	$match  = mysqli_num_rows($results);

	$res = mysqli_fetch_assoc($results);

	if($match > 0 ){		
	
		
		
		// login success
			$userData['id'] = $res['id'];
			$userData['name'] = $res['name'];
			$userData['password'] = $res['email'];
			$userData['active'] = $res['active'];
			echo ('{"userData":'.json_encode($userData).',"error":{"code":"000","message":"Logged in as '.$userData['name'].' "}}');
	
	}else{
		// login failed
		echo ('{"userData":'.json_encode($userData).', "error": {"code": "002","message": "The email or password you entered is incorrect."}}'.$password);			
	}
} else {
	// something failed with submitting data, should never get here!
	echo('{"userData":'.json_encode($userData).', "error": {"code":"005", "message": "Login error! Code: 005"}}');
}
?>
