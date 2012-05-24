<?php
	require '../../lib/db.php';
	$sql = $_GET["q"];
	echo $sql . "</br>";
	try {
		pg_query($db, $sql);
	} catch(Exception $e) {
		echo $e->getMessage();
	}
?>