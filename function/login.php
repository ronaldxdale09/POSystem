<?php
	include "db.php";
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$record=mysqli_query($con,"SELECT * FROM user WHERE username='$username'");
	$count = mysqli_num_rows($record);
	if($count == 0){
		echo "	<script type='text/javascript'>
					alert('No Record of Given Username');
					window.location='/posystem/login.php';
				</script>";
	}	
	else{
		$sql=mysqli_query($con,"SELECT * FROM user WHERE username='$username' and password='$password'");
		$count = mysqli_num_rows($sql);
		if($count == 0){
			echo "	<script type='text/javascript'>
						alert('Invalid Password!');
						window.location='/posystem/index.php';
					</script>";
		}
		else{
			$user = mysqli_fetch_array($sql);
			$userType = $user['type'];
			$_SESSION["type"] = $userType;
			$_SESSION["id"] = $user['id'];
			$_SESSION["user"] = $username;
			$_SESSION["username"] = $username;
			$_SESSION["pass"] = $password;
			$_SESSION['login'] = "success"; 
			$store_id =  $user['store'];
			$_SESSION["store_id"] = $store_id;
			$store = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM store WHERE id=$store_id"));
			$_SESSION["store"] = $store['name'];
			$_SESSION["store_address"] = $store['address'];
			$_SESSION["store_contact"] = $store['contactno'];
			header('Location: ../landing.php');
		}
	}
	//echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	mysqli_close($con);
?>