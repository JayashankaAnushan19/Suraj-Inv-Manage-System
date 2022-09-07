<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Load stock and view
	if (isset($_POST['stockSearch'])) {
		$stockSearchTXT = strtolower($_POST['stockSearchTXT']);

		if ($stockSearchTXT == 1) 
		{
			$stockSearchSql = "SELECT `tb_mylisting`.`mylisting_Name`, `tb_mylisting`.`mylisting_List_Qty`, SUM(`tb_buyandsell`.`buyAndSell_Qty`) FROM `tb_mylisting` LEFT JOIN `tb_buyandsell` ON `tb_mylisting`.`mylisting_ID` = `tb_buyandsell`.`tb_mylisting_mylisting_ID` WHERE `mylisting_active`='1' GROUP BY `mylisting_Name`";
		}
		else
		{
			$stockSearchSql = "SELECT `tb_mylisting`.`mylisting_Name`, `tb_mylisting`.`mylisting_List_Qty`, SUM(`tb_buyandsell`.`buyAndSell_Qty`) FROM `tb_mylisting` LEFT JOIN `tb_buyandsell` ON `tb_mylisting`.`mylisting_ID` = `tb_buyandsell`.`tb_mylisting_mylisting_ID` WHERE LOWER(`tb_mylisting`.`mylisting_Name`) LIKE '%$stockSearchTXT%' AND `mylisting_active`='1' GROUP BY `mylisting_Name` LIMIT 10";			
		}

		$stockSearchQuery = mysqli_query($conn, $stockSearchSql);

		if (mysqli_num_rows($stockSearchQuery) < 1 ) {
			echo "<tr><td colspan='6' style='text-align=center;'>No Data to Show</td></tr>";
		}
		elseif ($conn->error) {
			echo "<tr><td colspan='6' style='text-align=center;'>Database Err. Please contact system admin.</td></tr>";
		}
		else{
			$no = 1; 
			while($row = mysqli_fetch_assoc($stockSearchQuery))
			{
				$remainQty = ((int)$row['mylisting_List_Qty'] - (int)$row['SUM(`tb_buyandsell`.`buyAndSell_Qty`)']);
				if (is_null($remainQty) || empty($remainQty)) {
					$remainQty = "00";
				}
				else if($remainQty < 10){
					$remainQty = "0".$remainQty;
				}
				$soldQty = $row['SUM(`tb_buyandsell`.`buyAndSell_Qty`)'];
				if (is_null($row['SUM(`tb_buyandsell`.`buyAndSell_Qty`)']) || empty($row['SUM(`tb_buyandsell`.`buyAndSell_Qty`)'])) {
					$soldQty = "00";
				}
				else if($soldQty < 10){
					$soldQty = "0".$soldQty;
				}

				echo "<tr>
				<td>".$no."</td>
				<td>".$row['mylisting_Name']."</td>
				<td>".$row['mylisting_List_Qty']."</td>
				<td>".$soldQty."</td>
				<td>".$remainQty."</td>
				<td>
				<button class='btn btn-primary btn-md'>
				<i class='bi bi-pencil-square'> ... </i>
				</button>
				</td>
				</tr>";
				$no++;
			}
		}

	}

	//Load names to options
	if (isset($_POST['loadNamesToSales'])) {
		
		$data;

		if ($_POST['loadNamesToSales'] == 1) {
			$data = "<option value='-3'>AJAX Works</option>";
		}

		$loadDataNamesToSalesSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";

		$loadDataNamesToSalesQuery = mysqli_query($conn, $loadDataNamesToSalesSQL);

		if (mysqli_num_rows($loadDataNamesToSalesQuery) < 1 ) {
			$data = "<option value='-1'>No Data</option>";
		}
		elseif ($conn->error) {
			$data = "<option value='-2'>Connection Error</option>";
		}
		else{
			$data = "<option value='0'> - All - </option>";

			while($row = mysqli_fetch_assoc($loadDataNamesToSalesQuery))
			{				
				$data .= "<option value='".$row['mylisting_ID']."'>".$row['mylisting_Name']."</option>";				
			}			
		}

		echo $data;	
	}

	//Daily sales as a chart
	if (isset($_POST['showDailySales'])) {
		$From = $_POST['From'];
		$To = $_POST['To'];
		$selectedItemID = $_POST['selectedItemID'];

		$data;
		$dataSet;

		if ($selectedItemID != 0) {
			$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' AND `mylisting_ID`='$selectedItemID' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
		}
		else{
			$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
		}
		$chartData;		
		$loadDataNamesToSalesQuery = mysqli_query($conn, $loadNameandIDsSQL);
		if (mysqli_num_rows($loadDataNamesToSalesQuery) > 0) {
			$Products;
			$no = $mainNo = 0;
			while($row = mysqli_fetch_assoc($loadDataNamesToSalesQuery))
			{
				$Products[$no][0] = $row['mylisting_ID'];
				$Products[$no][1] = $row['mylisting_Name'];	
				$no++;			
			}

			for ($j=0; $j < count($Products); $j++) { 
				$prdctName = $Products[$j][1];				
				$prdctID = $Products[$j][0];

				
				$chartData[$mainNo][0] = $prdctName;

				$findSalesSQL = "SELECT * FROM `tb_buyandsell` WHERE `tb_mylisting_mylisting_ID` = '$prdctID' AND `buyAndSell_active`='1' AND (`buyAndSell_PaidDate` BETWEEN '$From' AND '$To')";

				$findSalesQuery = mysqli_query($conn, $findSalesSQL);

				
				$dataCollect;

				if (mysqli_num_rows($findSalesQuery) > 0){
					$i=0;
					while($row1 = mysqli_fetch_assoc($findSalesQuery)) {
						
						$date = date("Y,m,d",strtotime($row1['buyAndSell_PaidDate']));
						$chartData[$mainNo][1][$i][0] = $date;
						$chartData[$mainNo][1][$i][1]= $row1['buyAndSell_Qty'];

						$i++;					
					}
				}
				else{
					$date = date("Y-m-d");
					$chartData[$mainNo][1][0][0] = $date;
					$chartData[$mainNo][1][0][1] = 0;
				}
				$mainNo++;
			}
			
		}
		echo json_encode($chartData);
	}

	//Monthly sales as a chart
	if (isset($_POST['showMonthlySales'])) {
		$From = $_POST['From'];
		$To = $_POST['To'];
		$selectedItemID = $_POST['selectedItemID'];

		$data;
		$dataSet;

		if ($selectedItemID != 0) {
			$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' AND `mylisting_ID`='$selectedItemID' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
		}
		else{
			$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
		}
		$chartData;		
		$loadDataNamesToSalesQuery = mysqli_query($conn, $loadNameandIDsSQL);
		if (mysqli_num_rows($loadDataNamesToSalesQuery) > 0) {
			$Products;
			$no = $mainNo = 0;
			while($row = mysqli_fetch_assoc($loadDataNamesToSalesQuery))
			{
				$Products[$no][0] = $row['mylisting_ID'];
				$Products[$no][1] = $row['mylisting_Name'];	
				$no++;			
			}

			for ($j=0; $j < count($Products); $j++) { 
				$prdctName = $Products[$j][1];				
				$prdctID = $Products[$j][0];

				
				$chartData[$mainNo][0] = $prdctName;

				$findSalesSQL = "SELECT `buyAndSell_ID`,`tb_mylisting_mylisting_ID`,`buyAndSell_PaidDate`, SUM(`buyAndSell_Qty`) FROM `tb_buyandsell` WHERE `tb_mylisting_mylisting_ID` = '$prdctID' AND `buyAndSell_active`='1' AND (`buyAndSell_PaidDate` BETWEEN '$From' AND '$To') GROUP BY MONTH(`buyAndSell_PaidDate`)";

				$findSalesQuery = mysqli_query($conn, $findSalesSQL);

				
				$dataCollect;

				if (mysqli_num_rows($findSalesQuery) > 0){
					$i=0;
					while($row1 = mysqli_fetch_assoc($findSalesQuery)) {
						
						$date = date("Y,m,d",strtotime($row1['buyAndSell_PaidDate']));
						$chartData[$mainNo][1][$i][0] = $date;
						$chartData[$mainNo][1][$i][1]= $row1['SUM(`buyAndSell_Qty`)'];

						$i++;					
					}
				}
				else{
					$date = date("Y-m-d");
					$chartData[$mainNo][1][0][0] = $date;
					$chartData[$mainNo][1][0][1] = 0;
				}
				$mainNo++;
			}
			
		}
		echo json_encode($chartData);
	}

	// //Monthly sales as a chart
	// if (isset($_POST['showMonthlySales'])) {
	// 	$From = $_POST['From'];
	// 	$To = $_POST['To'];
	// 	$selectedItemID = $_POST['selectedItemID']; 

	// 	$data;
	// 	$dataSet;

	// 	if ($selectedItemID != 0) {
	// 		$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' AND `mylisting_ID`='$selectedItemID' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
	// 	}
	// 	else{
	// 		$loadNameandIDsSQL = "SELECT `mylisting_ID`,`mylisting_Name` FROM `tb_mylisting` WHERE `mylisting_active`='1' ORDER BY `tb_mylisting`.`mylisting_Name` ASC";
	// 	}
	// 	$chartData;		
	// 	$loadDataNamesToSalesQuery = mysqli_query($conn, $loadNameandIDsSQL);
	// 	if (mysqli_num_rows($loadDataNamesToSalesQuery) > 0) {
	// 		$Products;
	// 		$no = $mainNo = 0;
	// 		while($row = mysqli_fetch_assoc($loadDataNamesToSalesQuery))
	// 		{
	// 			$Products[$no][0] = $row['mylisting_ID'];
	// 			$Products[$no][1] = $row['mylisting_Name'];	
	// 			$no++;			
	// 		}

	// 		for ($j=0; $j < count($Products); $j++) { 
	// 			$prdctName = $Products[$j][1];				
	// 			$prdctID = $Products[$j][0];

				
	// 			$chartData[$mainNo][0] = $prdctName;

	// 			$findSalesSQL = "SELECT REPLACE(DATE_FORMAT(`buyAndSell_PaidDate`, '%Y-%m'),'-',''), `buyAndSell_PaidDate` FROM `tb_buyandsell`";

	// 			$findSalesQuery = mysqli_query($conn, $findSalesSQL);

				
	// 			$dataCollect;

	// 			if (mysqli_num_rows($findSalesQuery) > 0){
	// 				$i=0;
	// 				while($row1 = mysqli_fetch_assoc($findSalesQuery)) {
						
	// 					$date = date("Y,m,d",strtotime($row1['buyAndSell_PaidDate']));
	// 					$chartData[$mainNo][1][$i][0] = $date;
	// 					$chartData[$mainNo][1][$i][1]= $row1['buyAndSell_Qty'];

	// 					$i++;					
	// 				}
	// 			}
	// 			else{
	// 				$date = date("Y-m-d");
	// 				$chartData[$mainNo][1][0][0] = $date;
	// 				$chartData[$mainNo][1][0][1] = 0;
	// 			}
	// 			$mainNo++;
	// 		}
			
	// 	}
	// 	echo json_encode($chartData);
	// }



}
?>