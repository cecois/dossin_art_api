<?php
function pg2HTML($sql,$pgresults){ 

$htmlout = "<HTML><HEAD><TITLE>PostgreSQL Test Page</TITLE></HEAD><BODY>";
$htmlout .= "<TABLE>";

foreach($pgresults as $row){
       
$htmlout .=  "<TR>";
foreach($row as $field){
$htmlout .= "<td>$field</td>";}

$htmlout .= "</TR>";

		// Add feature array to array
/* 	      array_push($pg2json, $row); */

}


$htmlout .= "</TABLE><P>";
$htmlout .= "</BODY></HTML>";

header('Content-type: text/html',true);
echo $htmlout;   

}