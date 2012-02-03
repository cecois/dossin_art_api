<?php
function pg2KML($sql,$pgresults){ 
	
$kml = '<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2"
 xmlns:gx="http://www.google.com/kml/ext/2.2">
<Document>';

foreach($pgresults as $row){

  $tstamp=$row['exhib_year'];
  $descrip=$row['exhib_name'];
  html_entity_decode($descrip);
  $rid=$row['exhib_number'];
  $name=$row['exhib_name'];
  html_entity_decode($name);
  


    $kml .= '
      <Placemark id="'.$rid.'">';

$kml .= '<TimeStamp>
          <when>'.$tstamp.'</when>
        </TimeStamp>';
              
$kml .= '<name><![CDATA['.$name.']]></name>
        <description><![CDATA['.$descrip.']]></description>';

$kml .= $row['the_geom'];

      $kml .= '</Placemark>';



	}

$kml .= '</Document></kml>';
	header('Content-type: application/vnd.google-earth.kml+xml',true);
   // header('Content-type: application/xml',true);	 
   // header('Content-type: text/html',true);    
	return $kml;
}
