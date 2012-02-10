<?php
function pg2GEOJSON($sql,$pgresults){ 
	
	// Return as GeoJSON
   $geojson = array(
      'type'      => 'FeatureCollection',
      'features'  => array()
   );

foreach($pgresults as $row){
   $rowcount = count($row);
       $feature = array(
         'type' => 'Feature',
         'geometry' => json_decode($row['the_geom']),
         'crs' => array(
            'type' => 'EPSG',
            'properties' => array('code' => '4326')
         ),
         'properties' => array(
            'gid' => $row[0],
			'fename'=>$row[1],
         '2'=>$row[2],
         '3'=>$row[3],
         '4'=>$row[4],
         '5'=>$row[5],
         '6'=>$row[6],
         )
      );

		// Add feature array to feature collection array

// this is a gross @returnto but it kills the geom from the row since we used it already
// $filterOutKeys = array( 'the_geom', '17' );
// $row = array_diff_key( $row, array_flip( $filterOutKeys ) );

      // array_push($feature['properties'],array_splice($row,0));
	      array_push($geojson['features'], $feature);


	}
	header('Content-type: application/json',true);	 
	return json_encode($geojson);
}