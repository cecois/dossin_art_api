<?php
function pg2JSON($sql,$pgresults){ 

$pg2jsonresult = array('results');
$pg2json = array();


foreach($pgresults as $row){
       


		// Add feature array to array
	      array_push($pg2json, $row);

	}
	header('Content-type: application/json',true);
   array_push($pg2jsonresult,$pg2json);
   
	echo json_encode($pg2jsonresult);

}