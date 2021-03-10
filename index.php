<?php
	session_start();
	echo session_id()."<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

	require 'config.php';
	require 'lib/forms.php';
	require 'lib/vallidations.php';


	switch ($_GET["action"]) {
			case "logout":{
				$_SESSION = [];
				session_destroy();
				
			}break;
		case 'signin_user':


			if(checkUser($_POST["email"], $_POST["password"])){
				$_SESSION["auth"] = 1;
			}
			break;
		}

    function signup_form($errors_validation = [])
    {
    	if(count($errors_validation)){
    		echo "<ul>";
    		foreach ($errors_validation as $value){
    			echo "<li>$value</li>";
    		}

    		echo "</ul>";
    	}
    }
    if (strlen($_POST["password"]) < 8){
    	$errors_validation[] = "password too short";

    }

    if (strlen($_POST["password"]) < 12){
    	$errors_validation[] = "password is not safe";
    	
    }

    if (strlen($_POST["email"]) < 10){
    	$errors_validation[] = "this email is not exist";
    	
    }


    $signup_form($errors_validation);


	if(isset($_SESSION["auth"])){
		echo "<h1>Hello!!!!</h1>";
		echo "<a href='?action=logout'>Logout</a>";


	}else{
		switch ($_GET["action"]) {
		case 'signup_form':
			signupForm();
			break;
		case 'forgot_password_form':
			# code...
			break;
		case 'signup_user':
			$errors = signupValidation($_POST);
			if(count($errors) > 0){
				signupForm($errors);
			}else{
				signupUser($_POST);
				signinForm("Signup success. Signin.");	
			}
			break;
		
		default:
			signinForm();
			break;
	}
	}


?>
	
</body>
</html>






