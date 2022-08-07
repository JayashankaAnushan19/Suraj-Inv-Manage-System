<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Add new details
	if (isset($_POST['btnAdd']))
	{
		$txtName = $_POST['txtName'];
		$txtURL = $_POST['txtURL'];
		$txtListQty = $_POST['txtListQty'];
		$slctStatus = $_POST['slctStatus'];
		$txtUnitPriceUSD = $_POST['txtUnitPriceUSD'];
		$txtShippingCostUSD = $_POST['txtShippingCostUSD'];

		$msg;

		$sql = "INSERT INTO `db_suraj_shipping`.`tb_mylisting`
		(`mylisting_Name`, `mylisting_Status`, `mylisting_URL`, `mylisting_List_Qty`, `mylisting_UnitPrice_USD`, `mylisting_ShippingCost_USD`,`mylisting_active`) VALUES ('$txtName', '$slctStatus', '$txtURL','$txtListQty','$txtUnitPriceUSD','$txtShippingCostUSD','1')";

		if ($conn->query($sql) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			echo ($msg);
		}
	}

	//Search data to table
	if (isset($_POST['txtSearch'])) {
		$searchData = strtolower($_POST['searchData']);
		if ($searchData == 1) {
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_mylisting` WHERE `mylisting_active`='1'";
		}
		else{
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_mylisting` WHERE LOWER(`mylisting_Name`) LIKE '%$searchData%' AND `mylisting_active`='1' LIMIT 5";
		}

		$query = mysqli_query($conn, $searchSql);

		if (mysqli_num_rows($query) < 1 ) {
			echo "<tr><td colspan='8' style='text-align=center;'>No Data to Show</td></tr>";
		}
		elseif ($conn->error) {
			echo "<tr><td colspan='8' style='text-align=center;'>Database Err. Please contact system admin.</td></tr>";
		}
		else{
			$no = 1; 
			while($row = mysqli_fetch_assoc($query))
			{
				if ($row['mylisting_Status'] == 0) {
					$status = "Fix";
				}
				else{
					$status = "Auction";
				}
				$url = substr($row['mylisting_URL'], 0, 15) . "..";
				echo "<tr><td>".$no."</td><td>".$row['mylisting_Name']."</td><td>".$url."</td><td>".$row['mylisting_List_Qty']."</td><td>".$status."</td><td>".$row['mylisting_UnitPrice_USD']."</td><td>".$row['mylisting_ShippingCost_USD']."</td><td><button class='btn btn-warning btn-md' onclick='modifySearchU(".$row['mylisting_ID'].");'><i class='bi bi-pencil-square'></i></button><button class='btn btn-danger btn-md' onclick='modifySearchD(".$row['mylisting_ID'].");'><i class='bi bi-trash'></i></button></td></tr>";
				$no++;
			}
		}

	}

	// Search Data for update or Delete
	if (isset($_POST['idSearch'])) {
		$id = $_POST['id'];

		$idSearchSql = "SELECT * FROM `tb_mylisting` WHERE `mylisting_ID`='$id'";

		$idSearchQuery = mysqli_query($conn, $idSearchSql);

		while($row = mysqli_fetch_assoc($idSearchQuery))
		{
			$data[0] = $row['mylisting_ID'];
			$data[1] = $row['mylisting_Name'];
			$data[2] = $row['mylisting_URL'];
			$data[3] = $row['mylisting_List_Qty'];
			$data[4] = $row['mylisting_Status'];
			$data[5] = $row['mylisting_UnitPrice_USD'];
			$data[6] = $row['mylisting_ShippingCost_USD'];

			echo json_encode($data);;
		}

	}

	//Update data
	if (isset($_POST['btnUpdate'])) {
		$txtID = $_POST['txtID'];
		$txtName = $_POST['txtName'];
		$txtURL = $_POST['txtURL'];
		$txtListQty = $_POST['txtListQty'];
		$slctStatus = $_POST['slctStatus'];
		$txtUnitPriceUSD = $_POST['txtUnitPriceUSD'];
		$txtShippingCostUSD = $_POST['txtShippingCostUSD'];

		$msg;

		$updateSql ="UPDATE `db_suraj_shipping`.`tb_mylisting` SET `mylisting_Name`='$txtName',`mylisting_Status`='$slctStatus',`mylisting_URL`='$txtURL',`mylisting_List_Qty`='$txtListQty',`mylisting_UnitPrice_USD`='$txtUnitPriceUSD',`mylisting_ShippingCost_USD`='$txtShippingCostUSD' WHERE `mylisting_ID`='$txtID'";

		if ($conn->query($updateSql) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			echo ($msg);
		}
	}

	//Delete data
	if (isset($_POST['btnDelete'])) {
		$txtID = $_POST['txtID'];

		$deleteSql ="UPDATE `db_suraj_shipping`.`tb_mylisting` SET `mylisting_active`='0' WHERE `mylisting_ID`='$txtID'";

		if ($conn->query($deleteSql) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			echo ($msg);
		}
	}
}




?>