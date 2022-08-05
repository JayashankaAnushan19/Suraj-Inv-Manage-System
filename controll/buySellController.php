<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['txtFilterName']))
	{
		$name = $_POST['name'];

		$filterSQL = "SELECT * FROM `db_suraj_shipping`.`tb_mylisting` WHERE LOWER(`mylisting_Name`) LIKE '%$name%' AND `mylisting_active`='1' LIMIT 5";

		$filterSQLQuery = mysqli_query($conn, $filterSQL);

		if (mysqli_num_rows($filterSQLQuery) < 1) {
			echo "<tr style='background-color: lightblue;'><td colspan='8' style='text-align=center;'>No Data to Show</td></tr>";
		}
		else{
			$no = 1;
			while($row = mysqli_fetch_assoc($filterSQLQuery))
			{
				echo "<tr border='1' onclick='loadDataToText(".$row['mylisting_ID'].")' id='".$row['mylisting_ID']."' style='background-color: lightblue; cursor: pointer;'>
				<td colspan='8' style='text-align=left;'>".$row['mylisting_Name']."</td></tr>";
			}
		}
	}

	if (isset($_POST['loadDataToTXT'])) {
		
		$idToTXT = $_POST['idToTXT'];

		$listIdSearchSql = "SELECT * FROM `tb_mylisting` WHERE `mylisting_ID`='$idToTXT'";
		$remainQtySql = "SELECT SUM(`buyAndSell_Qty`) FROM `tb_buyandsell` WHERE `tb_mylisting_mylisting_ID`='$idToTXT'";

		$listIdSearchQuery = mysqli_query($conn, $listIdSearchSql);
		$listIdRemainQty = mysqli_query($conn, $remainQtySql);


		while($row = mysqli_fetch_assoc($listIdSearchQuery))
		{
			$data[0] = $row['mylisting_ID'];
			$data[1] = $row['mylisting_Name'];
			$data[2] = $row['mylisting_URL'];
			$data[3] = $row['mylisting_List_Qty'];
			$data[4] = $row['mylisting_Status'];
			if ($row['mylisting_Status'] == 0) {
				$data[4] = "Fix";
			}
			else if ($row['mylisting_Status'] == 1) {
				$data[4] = "Auction";
			}
			$data[5] = $row['mylisting_UnitPrice_USD'];
			$data[6] = $row['mylisting_ShippingCost_USD'];
			// $data[7] = $listIdRemainQty;
			while($row = mysqli_fetch_assoc($listIdRemainQty)){
				$data[7] = $row['SUM(`buyAndSell_Qty`)'];
			}

			echo json_encode($data);;
		}
	}

	if (isset($_POST['btnAdd'])) { 

		$txtSoldDate = $_POST['txtSoldDate'];
		$txtEbayOrderID = $_POST['txtEbayOrderID'];
		$txtAliOrderID = $_POST['txtAliOrderID'];
		$txtTrackingID = $_POST['txtTrackingID'];
		$txtCarrier = $_POST['txtCarrier'];
		$txtSoldQty = $_POST['txtSoldQty'];
		$txtSelingUnitCost = $_POST['txtSelingUnitCost'];
		$txtSellingShippingCost = $_POST['txtSellingShippingCost'];
		$txtPaypalCharge = $_POST['txtPaypalCharge'];
		$txtUSD_LKR_Rate = $_POST['txtUSD_LKR_Rate'];
		$listedItemID = $_POST['listedItemID'];

		$msg;

		$addDataSQL = "INSERT INTO `db_suraj_shipping`.`tb_buyandsell`(`buyAndSell_PaidDate`, `buyAndSell_Ebay_OrderID`, `buyAndSell_Ali_OrderID`, `buyAndSell_TrackingID`, `buyAndSell_Carrier`, `buyAndSell_Qty`, `buyAndSell_SellingUnitCostUSD`, `buyAndSell_SellingShippingCostUSD`, `buyAndSell_PaypalCharge_USD`, `buyAndSell_USD_LKR_Rate`, `tb_mylisting_mylisting_ID`, `buyAndSell_active`) VALUES ('$txtSoldDate','$txtEbayOrderID','$txtAliOrderID','$txtTrackingID','$txtCarrier','$txtSoldQty','$txtSelingUnitCost','$txtSellingShippingCost','$txtPaypalCharge','$txtUSD_LKR_Rate','$listedItemID','1')";

		if ($conn->query($addDataSQL) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			echo ($msg);
		}
	}

	if (isset($_POST['txtSearch'])) {
		$searchData = $_POST['searchData'];
		if ($searchData == 0) {
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_buyandsell` INNER JOIN `tb_mylisting` on `tb_buyandsell`.`tb_mylisting_mylisting_ID` = `tb_mylisting`.`mylisting_ID`  WHERE `tb_buyandsell`.`buyAndSell_active`='1'";
		}
		else{
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_buyandsell` INNER JOIN `tb_mylisting` on `tb_buyandsell`.`tb_mylisting_mylisting_ID` = `tb_mylisting`.`mylisting_ID`  WHERE `tb_mylisting`.`mylisting_Name` LIKE '%$searchData%' AND `tb_buyandsell`.`buyAndSell_active`='1' LIMIT 5";
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
				echo "<tr>
				<td>".$no."</td>
				</tr>";

				// echo "<tr>
				// <td>".$no."</td>
				// <td>".$row['tb_mylisting.mylisting_Name']."</td>
				// <td>".$row['tb_mylisting.mylisting_List_Qty']."</td>
				// <td>".$row['tb_mylisting.mylisting_UnitPrice_USD']."</td>
				// <td>".$row['tb_mylisting.mylisting_ShippingCost_USD']."</td>
				// <td>
				// <button class='btn btn-warning btn-md' onclick='modifySearchU(".$row['tb_mylisting.mylisting_ID'].");'>
				// <i class='bi bi-pencil-square'></i>
				// </button>
				// <button class='btn btn-danger btn-md' onclick='modifySearchD(".$row['tb_mylisting.mylisting_ID'].");'>
				// <i class='bi bi-trash'></i>
				// </button>
				// </td>
				// </tr>";
				// echo "<tr><td colspan='6' style='text-align=center;'>Database Err. Please contact system admin.</td></tr>";
				$no++;
			}
		}
	}



}



 ?>