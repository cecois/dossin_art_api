<?php
	$name = pg_escape_string($_POST['artistName']);
	$link = "http://127.0.0.1/altartlas/index.php/artistPut/" . $name . "/html";
	header('Location: ' . $link);
?>