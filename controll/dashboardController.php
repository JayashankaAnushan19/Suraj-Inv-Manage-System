<?php 
require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['dashData'])) {

		//Today sales
		$todaySaleSQL = "SELECT sum(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`) FROM `tb_buyandsell` WHERE `buyAndSell_PaidDate`= '".date("Y-m-d")."'";
		$todaySaleResult = mysqli_query($conn, $todaySaleSQL);
		if (mysqli_num_rows($todaySaleResult) > 0) {
			while($row = mysqli_fetch_assoc($todaySaleResult))
			{
				$data[0] = $row['sum(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`)'];
				if (is_null($row['sum(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`)'])) {
					$data[0] = 0;
				}
			}
		}
		else{
			$data[0] = 0;
		}


		//Monthly sales
		$first_day_this_month = date("Y-m-01"); 
		$last_day_this_month  = date("Y-m-d");
		$monthlySaleSQL = "SELECT SUM(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`) FROM `tb_buyandsell` WHERE (`buyAndSell_PaidDate` BETWEEN '$first_day_this_month' AND '$last_day_this_month')";
		$monthlySaleResult = mysqli_query($conn, $monthlySaleSQL);
		if (mysqli_num_rows($monthlySaleResult) > 0) {
			while($row = mysqli_fetch_assoc($monthlySaleResult))
			{
				$data[1] = $row['SUM(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`)'];
				if (is_null($row['SUM(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`)']) || $row['SUM(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`)'] == 0) {
					$data[1] = 0;
				}
			}
		}
		else{
			$data[1] = 0;
		}
		

		//Inventory count Fix
		$InvCountFixSQL = "SELECT COUNT(`mylisting_Name`) FROM `tb_mylisting` WHERE `mylisting_active`='1' AND `mylisting_Status`='0'";
		$InvCountFixResult = mysqli_query($conn, $InvCountFixSQL);
		if (mysqli_num_rows($InvCountFixResult) > 0) {
			while($row = mysqli_fetch_assoc($InvCountFixResult))
			{
				$data[2] = $row['COUNT(`mylisting_Name`)'];
				if (is_null($row['COUNT(`mylisting_Name`)']) || $row['COUNT(`mylisting_Name`)'] == 0) {
					$data[2] = 0;
				}
			}
		}
		else{
			$data[2] = 0;
		}


		//Inventory count Auction
		$InvCountAucSQL = "SELECT COUNT(`mylisting_Name`) FROM `tb_mylisting` WHERE `mylisting_active`='1' AND `mylisting_Status`='1'";
		$InvCountAucResult = mysqli_query($conn, $InvCountAucSQL);
		if (mysqli_num_rows($InvCountAucResult) > 0) {
			while($row = mysqli_fetch_assoc($InvCountAucResult))
			{
				$data[3] = $row['COUNT(`mylisting_Name`)'];
				if (is_null($row['COUNT(`mylisting_Name`)']) || $row['COUNT(`mylisting_Name`)'] == 0) {
					$data[3] = 0;
				}
			}
		}
		else{
			$data[3] = 0;
		}

		echo json_encode($data);
	}	
}
?>