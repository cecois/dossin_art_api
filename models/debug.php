<?php
function pg2DEBUG($sql,$pgresults){
$count = 0; 
echo $sql."<br/><br/>";
foreach($pgresults as $row){
$count = $count+1;

   }
   echo "total records: ".$count;
}