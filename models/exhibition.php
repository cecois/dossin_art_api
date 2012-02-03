<?php

function getExhibition($sqlstring){
global $db;

if ($db){
// $sqlstring = json_decode($sqlstring);
	$pgresults = $db->query($sqlstring);
	return $pgresults;
	}
    /*** close the database connection ***/
    $db = null;
    }
   ?>