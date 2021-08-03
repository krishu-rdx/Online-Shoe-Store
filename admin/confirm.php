		<?php
		include("../db/dbconn.php");
		
		$t_id = $_GET['id'];
		
		$conn->query("UPDATE transaction SET order_stat = 'Confirmed' WHERE transaction_id = '$t_id'") or die(mysqli_error());
						
		
		$query2 = $conn->query("SELECT * FROM transaction_detail LEFT JOIN product ON product.product_id = transaction_detail.product_id WHERE transaction_detail.transaction_id = '$t_id'") or die (mysqli_error());
		while($row = $query2->fetch_array()){
		
		$pid = $row['product_id'];
		$oqty = $row['order_qty'];
		
		$query3 = $conn->query("SELECT * FROM stock WHERE product_id = '$pid'") or die (mysqli_error());
		$row3 = $query3->fetch_array();
		
		$stck = $row3['qty']; 
		
		$stck_out = $stck - $oqty;
		
		$query = $conn->query("UPDATE stock SET qty = '$stck_out' WHERE product_id = '$pid'") or die(mysqli_error());
		}
		header("location: transaction.php");	
		
		?>