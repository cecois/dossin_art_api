<?php
	// artists
	$artistsId = getData('artists', 'id');
	$artistsName = getData('artists', 'name');
	
	// cities
	$citiesId = getData('cities', 'id');
	$citiesName = getData('cities', 'name');
	$citiesFk_countries_id = getData('cities', 'fk_countries_id');
	
	// countries
	$countriesId = getData('countries', 'id');
	$countriesIso = getData('countries', 'iso');
	$countriesName = getData('countries', 'name');
	
	// exhibition_spaces
	$exhibition_spacesId = getData('exhibition_spaces', 'id');
	$exhibition_spacesName = getData('exhibition_spaces', 'name');
	$exhibition_spacesFk_cities_id = getData('exhibition_spaces', 'fk_cities_id');
	
	// exhibitions
	$exhibitionsId = getData('exhibitions', 'id');
	$exhibitionsExhib_number = getData('exhibitions', 'exhib_number');
	$exhibitionsExhib_name = getData('exhibitions', 'exhib_name');
	$exhibitionsExhib_year = getData('exhibitions', 'exhib_year');
	$exhibitionsFk_exhibition_spaces_id = getData('exhibitions', 'fk_exhibition_spaces_id');
	
	// exhibitions_has_artists
	$exhibitions_has_artistsFk_exhibitions_id = getData('exhibitions_has_artists', 'fk_exhibitions_id');
	$exhibitions_has_artistsFk_artists_id = getData('exhibitions_has_artists', 'fk_artists_id');
	
	// exhibitions_has_cities
	$exhibitions_has_citiesFk_exhibitions_id = getData('exhibitions_has_cities', 'fk_exhibitions_id');
	$exhibitions_has_citiesFk_cities_id = getData('exhibitions_has_cities', 'fk_cities_id');
		
	// exhibitions_has_works
	$exhibitions_has_worksFk_exhibitions_id = getData('exhibitions_has_works', 'fk_exhibitions_id');
	$exhibitions_has_worksFk_works_id = getData('exhibitions_has_works', 'fk_works_id');
	
	// works
	$worksId = getData('works', 'id');
	$worksName = getData('works', 'name');
	$worksYear = getData('works', 'year');
	
	
	/* Get Data */
	/* Simply SELECT data from the provided table and column */
	function getData($table, $column) {
		require 'lib/db_admin.php';
		try {
			$sql = "SELECT " . $column . " FROM " . $table;
			$pgresults = pg_query($db, $sql);
			$db = null;
		} catch(Exception $e) { echo $e->getMessage(); }
		return json_encode(array_values(pg_fetch_all($pgresults)));
	}
	
	
	
	
	
	
	
	
	// all data
	$allData = allData();
	// 0 	- artistsId
	// 1 	- artistsName
	
	// 2	- citiesId
	// 3 	- citiesName
	// 4	- citiesFk_countries_id
	
	// 5	- countriesId
	// 6	- countriesIso
	// 7 	- countriesName
	
	// 8	- exhibition_spacesId
	// 9 	- exhibition_spacesName
	// 10	- exhibition_spacesFk_cities_id
	
	// 11	- exhibitionsId
	// 12	- exhibitionsExhib_number
	// 13	- exhibitionsExhib_name
	// 14 	- exhibitionsExhib_year
	// 15	- exhibitionsRealism
	// 16	- exhibitionsSurrealism
	// 17	- exhibitionsAbstractexpress
	// 18	- exhibitionsPostexpress
	// 19	- exhibitionsNeodada
	// 20	- exhibitionsPopart
	// 21	- exhibitionsMinimal
	// 22	- exhibitionsConceptualart
	// 23	- exhibitionsVisitorcount
	// 24	- exhibitionsIsmuseum
	// 25	- exhibitionsOnlyus
	// 26 	- exhibitionsExhib_from_us
	// 27	- exhibitionsFk_exhibition_spaces_id
	
	// 28	- exhibitions_has_artistsFk_exhibitions_id
	// 29	- exhibitions_has_artistsFk_artists_id
	
	// 30	- exhibitions_has_citiesFk_exhibitions_id
	// 31	- exhibitions_has_citiesFk_cities_id
	
	// 32	- exhibitions_has_worksFk_exhibitions_id
	// 33	- exhibitions_has_worksFk_works_id
	
	// 34	- worksId
	// 35 	- worksName
	// 36 	- worksYear
	
	
	/* Get ALL Data */
	/* This is a function that attempts to create an array of ALL of the data in the database. Takes time, but made portions of the javascript easier. */
	function allData() {
		require 'lib/db_admin.php';
		$data;
		
		// Exhibitions Data
		$exhibitionsSQL = "SELECT id, exhib_number, exhib_name, exhib_year, realism, surrealism, abstractexpress, postexpress, neodada, popart, minimal, conceptualart, visitorcount, ismuseum, onlyus, exhib_from_us, fk_exhibition_spaces_id FROM exhibitions"; 
		$exhibitionsData = pg_query($db, $exhibitionsSQL);
		
		// Row count
		$rn = 0;
		
		// Loop through every exhibition
		while($exhibition = pg_fetch_array($exhibitionsData)) {
		
			// Grab exhibition space data
			$exhibition_spacesSQL = "SELECT id, name, fk_cities_id FROM exhibition_spaces WHERE id=" . $exhibition[16];
			$exhibition_spacesData = pg_query($db, $exhibition_spacesSQL);
			$exhibition_space = pg_fetch_array($exhibition_spacesData);
			
			// Grab city link data
			$citiesLinkSQL = "SELECT fk_exhibitions_id, fk_cities_id FROM exhibitions_has_cities WHERE fk_exhibitions_id=" . $exhibition[0];
			$citiesLinkData = pg_query($db, $citiesLinkSQL);
			
			// Loop through city ids
			while($citiesLink = pg_fetch_array($citiesLinkData)) {
				
				// Grab city data
				$citiesSQL = "SELECT id, name, fk_countries_id FROM cities WHERE id=" . $citiesLink[1];
				$citiesData = pg_query($db, $citiesSQL);
				$city = pg_fetch_array($citiesData);
				
				// Grab country data
				$countriesSQL = "SELECT id, iso, name FROM countries WHERE id=" . $city[2];
				$countriesData = pg_query($db, $countriesSQL);
				$country = pg_fetch_array($countriesData);
				
				// Grab artist link data
				$artistsLinkSQL = "SELECT fk_exhibitions_id, fk_artists_id FROM exhibitions_has_artists WHERE fk_exhibitions_id=" . $exhibition[0];
				$artistsLinkData = pg_query($db, $artistsLinkSQL);
				
				// Loop through artists ids
				while($artistsLink = pg_fetch_array($artistsLinkData)) {
				
					// Grab artists data
					$artistsSQL = "SELECT id, name FROM artists WHERE id=" . $artistsLink[1];
					$artistsData = pg_query($db, $artistsSQL);
					$artist = pg_fetch_array($artistsData);
					
					// Grab works link data
					$worksLinkSQL = "SELECT fk_exhibitions_id, fk_works_id FROM exhibitions_has_works WHERE fk_exhibitions_id=" . $exhibition[0];
					$worksLinkData = pg_query($db, $worksLinkSQL);
					
					// Loop through works ids
					while($worksLink = pg_fetch_array($worksLinkData)) {
					
						// Grab works data
						$worksSQL = "SELECT id, name, year FROM works WHERE id=" . $worksLink[1];
						$worksData = pg_query($db, $worksSQL);
						$work = pg_fetch_array($worksData);
						
						$data[$rn][0] 	= $artist[0];
						$data[$rn][1] 	= $artist[1];
						
						$data[$rn][2]	= $city[0];
						$data[$rn][3]	= $city[1];
						$data[$rn][4]	= $city[2];
						
						$data[$rn][5]	= $country[0];
						$data[$rn][6]	= $country[1];
						$data[$rn][7]	= $country[2];
						
						$data[$rn][8]	= $exhibition_space[0];
						$data[$rn][9]	= $exhibition_space[1];
						$data[$rn][10]	= $exhibition_space[2];
						
						$data[$rn][11]	= $exhibition[0];
						$data[$rn][12]	= $exhibition[1];
						$data[$rn][13]	= $exhibition[2];
						$data[$rn][14]	= $exhibition[3];
						$data[$rn][15]	= $exhibition[4];
						$data[$rn][16]	= $exhibition[5];
						$data[$rn][17]	= $exhibition[6];
						$data[$rn][18]	= $exhibition[7];
						$data[$rn][19]	= $exhibition[8];
						$data[$rn][20]	= $exhibition[9];
						$data[$rn][21]	= $exhibition[10];
						$data[$rn][22]	= $exhibition[11];
						$data[$rn][23]	= $exhibition[12];
						$data[$rn][24]	= $exhibition[13];
						$data[$rn][25]	= $exhibition[14];
						$data[$rn][26]	= $exhibition[15];
						$data[$rn][27]	= $exhibition[16];
						
						$data[$rn][28]	= $artistsLink[0];
						$data[$rn][29]	= $artistsLink[1];
						
						$data[$rn][30]	= $citiesLink[0];
						$data[$rn][31]	= $citiesLink[1];
						
						$data[$rn][32]	= $worksLink[0];
						$data[$rn][33]	= $worksLink[1];
						
						$data[$rn][34]	= $work[0];
						$data[$rn][35]	= $work[1];
						$data[$rn][36]	= $work[2];
						
						$rn++;
						
					}	
				}	
			}
		}
		
		return json_encode($data);
	}
?>