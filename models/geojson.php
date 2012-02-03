<?php
function pg2GEOJSON($sql,$pgresults){ 
	
	// Return as GeoJSON
   $geojson = array(
      'type'      => 'FeatureCollection',
      'features'  => array()
   );

foreach($pgresults as $row){
       $feature = array(
         'type' => 'Feature',
         'geometry' => json_decode($row['the_geom']),
         'crs' => array(
            'type' => 'EPSG',
            'properties' => array('code' => '4326')
         ),
         'properties' => array(
            'gid' => $row[0],
			'fename'=>$row[1]
         )
      );


		// Add feature array to feature collection array
	      array_push($geojson['features'], $feature);

	}
	header('Content-type: application/json',true);	 
	return json_encode($geojson);
}