<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
		(`mylisting_Name`, `mylisting_Status`, `mylisting_URL`, `mylisting_List_Qty`, `mylisting_UnitPrice_USD`, `mylisting_ShippingCost_USD`) VALUES ('$txtName', '$slctStatus', '$txtURL','$txtListQty','$txtUnitPriceUSD','$txtShippingCostUSD')";

		if ($conn->query($sql) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			if ($msg = "%Duplicate%") {
				$msg = 1;
			}
			echo ($msg);
		}
	}

	if (isset($_POST['txtSearch'])) {
		$searchData = $_POST['searchData'];
		if ($searchData == 0) {
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_mylisting`";
		}
		else{
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_mylisting` WHERE `mylisting_Name` LIKE '%$searchData%' LIMIT 5";
		}

		$query = mysqli_query($conn, $searchSql);

		if (mysqli_num_rows($query) < 1) {
			echo "<tr><td colspan='8' style='text-align=center;'>No Data to Show</td></tr>";
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
				echo "<tr><td>".$no."</td><td>".$row['mylisting_Name']."</td><td>".$url."</td><td>".$row['mylisting_List_Qty']."</td><td>".$status."</td><td>".$row['mylisting_UnitPrice_USD']."</td><td>".$row['mylisting_ShippingCost_USD']."</td><td><button class='btn btn-warning btn-md' onclick='modifySearch(".$row['mylisting_ID'].");'><i class='bi bi-pencil-square'></i></button><button class='btn btn-danger btn-md' onclick='modifySearch(".$row['mylisting_ID'].");'><i class='bi bi-trash'></i></button></td></tr>";
				$no++;
			}
		}

	}
}




?>