<?php
	$link = "http://127.0.0.1/altartlas/index.php/exhibitions/html?";
	$startYear = $_GET["startYear"]; 
	$endYear = $_GET["endYear"];
	
	if($startYear === '' and $endYear === '')
	{
	}
	else
	{
		$link.= "year_start=" . $startYear . "&year_end=" . $endYear;
	}
	
	header('Location: ' . $link);
?>