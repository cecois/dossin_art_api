<?php
	$link = "http://127.0.0.1/altartlas/index.php/artists/html?";
	$alphabetical = $_GET["alphabetical"];
	if($alphabetical)
	{
		$link.= "orderby=name";
	}
	header('Location: ' . $link);
?>