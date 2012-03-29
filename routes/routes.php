<?php
	/*
	*  Get Artists
	*/
	function getArtists($outform)
	{
		include_once 'lib/orderbuilder.php';
		
		$sql = "SELECT * FROM artists";
		$params = $_REQUEST;
		if(count($params) > 0)
		{
			$orderclause = buildOrder($params);
			$sql.= $orderclause;
		}
		
		$fieldsToOutput = array("id", "name");
		produceOutput($outform, $sql, $fieldsToOutput);
	}
	
	/*
	*  Get Exhibitions
	*/
	function getExhibitions($outform)
	{
		include_once 'lib/wherebuilder.php';
		include_once 'lib/joinbuilder.php';
		include_once 'lib/orderbuilder.php';
	
		$sql = "SELECT * FROM exhibitions";
		$params = $_REQUEST;
		if(count($params) > 0)
		{
			$joinclause = buildJoinForExhibitions($params);
			$whereclause = buildWhere($params);
			$orderclause = buildOrder($params);
			$sql.= $joinclause;
			$sql.= ' ' . $whereclause;
			$sql.= $orderclause;
			
		}
		$fieldsToOutput = array("id", "exhib_name");
		produceOutput($outform, $sql, $fieldsToOutput, $params);
	}
	
	/*
	*  Get Works
	*/
	function getWorks($outform)
	{
		$sql = "SELECT * FROM works";
		$fieldsToOutput = array("id", "name", "year", "height", "width", "isdrip", "isguggen");
		produceOutput($outform, $sql, $fieldsToOutput);
	}
	
	/*
	*  Get Exhibition Spaces
	*/
	function getExhibitionSpaces($outform)
	{
		$sql = "SELECT * FROM exhibition_spaces";
		$fieldsToOutput = array("id", "name_raw", "name", "fb_lng", "fb_lat");
		produceOutput($outform, $sql, $fieldsToOutput);
	}
	
	/*
	*  Get Countries
	*/
	function getCountries($outform)
	{
		$sql = "SELECT * FROM countries";
		$fieldsToOutput = array("id", "name");
		produceOutput($outform, $sql, $fieldsToOutput);
	}
	
	/*
	*  Get Cities
	*/
	function getCities($outform)
	{
	}
	
	/*
	*  Get Fields
	*/
	function getFields($outform)
	{
	}
	
	/*
	*  Put Artist
	*/
	function putArtist($artist, $outform)
	{
		global $db;
		$sqlAdd = "INSERT INTO artists(name) VALUES('" .$artist . "')";
		pg_query($db, $sqlAdd);
	}
	
	
	function produceOutput($outform, $sql, $fieldsToOutput, $params)
	{
		// Global app variable to set a proper header for actual kml clients later
		global $app;
		
		// Global database variable
		global $db;
		
		// Include models
		include_once 'models/models.php';
		
		// Try-catch block to catch any wayward exceptions
		try
		{	
			// Set the output parser
			$outparser = 'pg2' . strtoupper($outform);

			// Execute SQL query
			$pgresults = pg_query($db, $sql);
			
			// Close the connection
			$db = null;
			$result['data'] = $pgresults;
			$result['success'] = true;
		}
		catch(Exception $e)
		{
			// Catch any exceptions and report the problem
			$result = array();
			$result['success'] = false;
			$result['errormsg'] = $e->getMessage();
		}
		
		// Format the output
		echo $outparser($result['data'], $fieldsToOutput,$sql,$params);
		exit();
	}	
?>