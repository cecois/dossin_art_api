<?php


	/*
	* Get exhibition filters
	*/

	function getFilters($entity,$outform)
	{
		include_once 'lib/orderbuilder.php';
		
		
		
		$sql="SELECT attname,col_description(attrelid,attnum) as desc,
    pg_catalog.format_type(pg_attribute.atttypid, pg_attribute.atttypmod) as type 
    FROM pg_attribute, pg_class WHERE pg_class.oid = attrelid AND attnum>0 
    AND relname = '".$entity."' AND not col_description(attrelid,attnum) IS NULL AND pg_attribute.attrelid = (
        SELECT c.oid
        FROM pg_catalog.pg_class c
            LEFT JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
        WHERE c.relname ~ '^(".$entity.")$'
            AND pg_catalog.pg_table_is_visible(c.oid)
    );";



		$params = $_REQUEST;
		if(count($params) > 0)
		{
			$orderclause = buildOrder($params);
			$sql.= $orderclause;
		}
		
		$fieldsToOutput = array("attname", "desc","type");
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}

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
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}
	
	/*
	*  Get Exhibitions
	*/
	function getExhibitions($outform)
	{
		include_once 'lib/wherebuilder.php';
		include_once 'lib/joinbuilder.php';
		include_once 'lib/orderbuilder.php';

		switch ($outform) {
			case 'geojson':
				$the_geom = 'st_asgeojson(st_transform(the_geom,4326)) the_geom';
				break;

			case 'json':
				$the_geom = 'ST_AsEWKT(st_transform(the_geom,4326)) the_geom';
				break;	

			case 'kml':
				$the_geom = 'st_askml(st_transform(the_geom,4326)) the_geom';
				break;	

			default:
				$the_geom = 'st_astext(st_transform(the_geom,4326)) the_geom';
				break;
		}

		$fieldsToOutput = array("ex.id id", "exhib_name","exhib_year","exhib_number",$the_geom,"countries.name");

		$sql = "SELECT ";

		$sql .= implode(',',$fieldsToOutput);
	
		$sql .= " FROM exhibitions ex";

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
		
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}

	/*
	*  Get Artist Works
	*/
	function getArtistWorks($artistid,$outform) {
		include_once 'lib/wherebuilder.php';
		include_once 'lib/joinbuilder.php';
		include_once 'lib/orderbuilder.php';

		switch ($outform) {
			case 'geojson':
				$the_geom = 'st_asgeojson(st_transform(the_geom,4326)) the_geom';
				break;

			case 'json':
				$the_geom = 'ST_AsEWKT(st_transform(the_geom,4326)) the_geom';
				break;	

			case 'kml':
				$the_geom = 'st_askml(st_transform(the_geom,4326)) the_geom';
				break;	

			default:
				$the_geom = 'st_astext(st_transform(the_geom,4326)) the_geom';
				break;
		}

		$fieldsToOutput = array("ex.id id", "exhib_name","exhib_year","exhib_number",$the_geom,"countries.name","isdrip");

		$sql = "SELECT ";

		$sql .= implode(',',$fieldsToOutput);
	
		$sql .= " FROM exhibitions ex";

		$params = $_REQUEST;
		$params["artistid"] = $artistid;
		if(count($params) > 0)
		{
			$joinclause = buildJoinForExhibitions($params);
			$whereclause = buildWhere($params);
			$orderclause = buildOrder($params);
			$sql.= $joinclause;
			$sql.= ' ' . $whereclause;
			$sql.= $orderclause;

			
		}
		
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}
	
	/*
	*  Get Works
	*/
	function getWorks($outform)
	{
		$sql = "SELECT * FROM works";
		$fieldsToOutput = array("id", "name", "year", "height", "width", "isdrip", "isguggen");
		$params = $_REQUEST;
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}
	
	/*
	*  Get Exhibition Spaces
	*/
	function getExhibitionSpaces($outform)
	{
		$sql = "SELECT * FROM exhibition_spaces";
		$fieldsToOutput = array("id", "name_raw", "name", "fb_lng", "fb_lat");
		$params = $_REQUEST;
		produceOutput($outform, $fieldsToOutput, $sql, $params);
	}
	
	/*
	*  Get Countries
	*/
	function getCountries($outform)
	{
		$sql = "SELECT * FROM countries";
		$fieldsToOutput = array("id", "name");
		$params = $_REQUEST;
		produceOutput($outform, $fieldsToOutput, $sql, $params);
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
	
	
	function produceOutput($outform, $fieldsToOutput, $sql, $params)
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