<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['loginCheck'])) 
	{
		$UName = $_POST['UName'];
		$Password = $_POST['Password'];

		$filterSQL = "SELECT * FROM `db_suraj_shipping`.`tb_login` WHERE `login_UserName`='$UName' AND `login_Password`='$Password' LIMIT 1";

		$filterSQLQuery = mysqli_query($conn, $filterSQL);

		if (mysqli_num_rows($filterSQLQuery)>0) {	
			while($row = mysqli_fetch_assoc($filterSQLQuery)){
				if (session_status() === PHP_SESSION_NONE || $_SESSION["id"] == "") {
					session_start();
					$_SESSION["uname"] = $row['login_UserName'];
					$_SESSION["id"] = $row['login_ID'];
					$_SESSION["accLvl"] = $row['login_level'];
					$_SESSION["pass"] = $row['login_Password'];
				}
				else{
					$_SESSION["uname"] = $row['login_UserName'];
					$_SESSION["id"] = $row['login_ID'];
					$_SESSION["accLvl"] = $row['login_level'];
					$_SESSION["pass"] = $row['login_Password'];
				}
			}
			echo "1";
		}
		else{
			echo "0";
		}
	}
	
}

?>