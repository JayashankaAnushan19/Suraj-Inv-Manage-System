<?php 
require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$todaySaleSQL = "SELECT sum(`buyAndSell_Qty`*`buyAndSell_SellingUnitCostUSD`) FROM `tb_buyandsell` WHERE `buyAndSell_PaidDate`= '2022-08-19'";
	$todaySaleResult = mysqli_query($conn, $todaySaleSQL);
	while($row = mysqli_fetch_assoc($todaySaleResult))
	{
		
	}
}
?>