<?php 
require_once '../model/connection.php';

if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
	session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	/*Load all the data to the view*/
	if (isset($_POST['loadData'])) 
	{	
		$data;
		$data[0] = $_SESSION["uname"];
		$data[1] = $_SESSION["accLvl"];
		if ($data[1] == 0) {
			$data[1] = "Super Admin";
		}
		else if ($data[1] == 1) {
			$data[1] = "Admin"; 
		}
		else{
			$data[1] = "User";
		}

		echo json_encode($data);
	}
	

	/*Change Password*/
	if (isset($_POST['changePass'])) 
	{
		$id = $_SESSION["id"];
		$OldPass = $_POST['oldPass'];
		$NewPass = $_POST['newPass'];

		if ($OldPass == $_SESSION["pass"]){
			$changPass = "UPDATE `tb_login` SET `login_Password`='$NewPass' WHERE `login_ID`='$id'";
			if (mysqli_query($conn, $changPass)) {
				echo "ok";
			}
			else{
				echo "Connection error. Please contact system admin.";
			}
		}
		else{
			echo "Invalid password. Please enter valid password. Err(Wrong password.)";
		}
	}


	/*Change User name*/
	if (isset($_POST['changeUName'])) 
	{
		$UserName = $_POST['UsrName'];
		$id = $_SESSION["id"];

		$changeUName = "UPDATE `tb_login` SET `login_UserName`='$UserName' WHERE `login_ID`='$id'";
		if (mysqli_query($conn, $changeUName)) {
			$_SESSION["uname"] = $UserName;
			echo "UserName changed successfully.";
		}
		else{
			echo "Connection error. Please contact system admin.";
		}

	}
}
?>