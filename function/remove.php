<?php
include('../db/dbconn.php');

$id = $_POST['id'];

	$conn->query("DELETE FROM product WHERE product_id = '$id'") or die(mysqli_error());

?>