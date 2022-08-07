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

		$listIdSearchSql = "SELECT * FROM `tb_mylisting` WHERE `mylisting_ID`='$idToTXT' AND `mylisting_active`='1'";
		$remainQtySql = "SELECT SUM(`buyAndSell_Qty`) FROM `tb_buyandsell` WHERE `tb_mylisting_mylisting_ID`='$idToTXT' AND `buyAndSell_active`='1'";

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

			while($rowxx = mysqli_fetch_assoc($listIdRemainQty)){
				$data[7] = $rowxx['SUM(`buyAndSell_Qty`)'];
			}

			echo json_encode($data);
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
		$searchData = strtolower($_POST['searchData']);
		if ($searchData == 0) {
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_buyandsell` INNER JOIN `tb_mylisting` on `tb_buyandsell`.`tb_mylisting_mylisting_ID` = `tb_mylisting`.`mylisting_ID`  WHERE `tb_buyandsell`.`buyAndSell_active`='1'";
		}
		else{ 
			$searchSql = "SELECT * FROM `db_suraj_shipping`.`tb_buyandsell` INNER JOIN `tb_mylisting` on `tb_buyandsell`.`tb_mylisting_mylisting_ID` = `tb_mylisting`.`mylisting_ID`  WHERE LOWER(`tb_mylisting`.`mylisting_Name`) LIKE '%$searchData%' AND `tb_buyandsell`.`buyAndSell_active`='1' LIMIT 5";
		}

		$query = mysqli_query($conn, $searchSql);

		if (mysqli_num_rows($query) < 1 ) {
			echo "<tr><td colspan='6' style='text-align=center;'>No Data to Show</td></tr>";
		}
		elseif ($conn->error) {
			echo "<tr><td colspan='6' style='text-align=center;'>Database Err. Please contact system admin.</td></tr>";
		}
		else{
			$no = 1;
			while($row = mysqli_fetch_assoc($query))
			{
				$today = date("F j, Y",strtotime($row['buyAndSell_PaidDate']));
				echo "<tr>
				<td>".$no."</td>
				<td>".$row['mylisting_Name']."</td>
				<td>".$today."</td>
				<td>".$row['buyAndSell_Qty']."</td>
				<td>".$row['buyAndSell_SellingUnitCostUSD']."</td>
				<td>
				<button class='btn btn-warning btn-md' onclick='modifySearchU(".$row['buyAndSell_ID'].");'>
				<i class='bi bi-pencil-square'></i>
				</button>
				<button class='btn btn-danger btn-md' onclick='modifySearchD(".$row['buyAndSell_ID'].");'>
				<i class='bi bi-trash'></i>
				</button>
				</td>
				</tr>";
				$no++;
			}
		}
	}

	if (isset($_POST['idSearch'])) {
		$id = $_POST['id'];

		$idSearchSql = "SELECT * FROM `db_suraj_shipping`.`tb_buyandsell` INNER JOIN `tb_mylisting` on `tb_buyandsell`.`tb_mylisting_mylisting_ID` = `tb_mylisting`.`mylisting_ID`  WHERE `tb_buyandsell`.`buyAndSell_ID` ='$id' AND `tb_buyandsell`.`buyAndSell_active`='1' LIMIT 1";

		$idSearchQuery = mysqli_query($conn, $idSearchSql);

		while($row = mysqli_fetch_assoc($idSearchQuery))
		{
			$data[0] = $row['buyAndSell_ID'];
			$data[1] = $row['mylisting_Name'];
			$data[2] = $row['mylisting_URL'];
			$data[3] = $row['mylisting_Status'];
			$data[4] = $row['mylisting_List_Qty'];
			$data[5] = "NA";
			$data[6] = $row['mylisting_UnitPrice_USD'];
			$data[7] = $row['mylisting_ShippingCost_USD'];			
			$data[8] = $row['buyAndSell_SellingUnitCostUSD'];
			$data[9] = $row['buyAndSell_SellingShippingCostUSD'];
			$data[10] = $row['buyAndSell_PaidDate'];
			$data[11] = $row['buyAndSell_Qty'];
			$data[12] = $row['buyAndSell_Ebay_OrderID'];
			$data[13] = $row['buyAndSell_Ali_OrderID'];
			$data[14] = $row['buyAndSell_TrackingID'];
			$data[15] = $row['buyAndSell_Carrier'];
			$data[16] = $row['buyAndSell_PaypalCharge_USD'];
			$data[17] = $row['buyAndSell_USD_LKR_Rate'];
			echo json_encode($data);;
		}

	}

	if (isset($_POST['btnUpdate'])) {
		$txtID = $_POST['txtID'];
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

		$msg;

		$updateSql ="UPDATE `db_suraj_shipping`.`tb_buyandsell` SET 
		`buyAndSell_PaidDate`='$txtSoldDate',
		`buyAndSell_Ebay_OrderID`='$txtEbayOrderID',
		`buyAndSell_Ali_OrderID`='$txtAliOrderID',
		`buyAndSell_TrackingID`='$txtTrackingID',
		`buyAndSell_Carrier`='$txtCarrier',
		`buyAndSell_Qty`='$txtSoldQty',
		`buyAndSell_SellingUnitCostUSD`='$txtSelingUnitCost',
		`buyAndSell_SellingShippingCostUSD`='$txtSellingShippingCost',
		`buyAndSell_PaypalCharge_USD`='$txtPaypalCharge',
		`buyAndSell_USD_LKR_Rate`='$txtUSD_LKR_Rate'
		WHERE `buyAndSell_ID`='$txtID'";

		if ($conn->query($updateSql) === TRUE) {
			$msg = 0;
			echo ($msg);
		}
		else {
			$msg  = $conn->error;
			echo ($msg);
		}
	}

	if (isset($_POST['btnDelete'])) {
		$txtID = $_POST['txtID'];

		$deleteSql ="UPDATE `db_suraj_shipping`.`tb_buyandsell` SET `buyAndSell_active`='0' WHERE `buyAndSell_ID`='$txtID'";

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