<?php
function pg2JSON($sql,$pgresults){ 

$pg2jsonresult['results'] = array();
$pg2json = array();


foreach($pgresults as $row){
       
		// Add feature array to array
	     array_push($pg2json,$row);
	    
	}
	

   array_push($pg2jsonresult['results'],$pg2json);
   
	header('Content-type: application/json',true);
	echo json_encode($pg2jsonresult);

}