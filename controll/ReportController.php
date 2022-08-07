<?php 

require_once '../model/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

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



}
?>