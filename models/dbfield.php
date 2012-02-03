<?php

function getField($sqlstring){

global $db;

if ($db){
	$pgresults = $db->query($sqlstring);
	return $pgresults;
	}
    /*** close the database connection ***/
    $db = null;
    }
   ?>