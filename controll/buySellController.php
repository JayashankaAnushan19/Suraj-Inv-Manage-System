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



}



 ?>