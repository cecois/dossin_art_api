<?php
function buildWhere($paramarray) {
    $whereArr = array();
    // to prevent injection during what we'll do next, we need to limit valid keys
    $acceptedIncomingVars = array('exhib_number', 'year_start', 'year_end', 'realism', 'surrealism', 'abstractexpress', 'postexpress', 'neodada', 'popart', 'minimal', 'conceptualart', 'ismuseum', 'onlyus', 'exhib_from_us','artistid','polylimit','isdrip','isguggen','workid');

    // loop through request as array
    foreach ($paramarray as $key => $value) {
        // lowercase it
        $key = strtolower($key);
        // if it's acceptable
        if (in_array($key, $acceptedIncomingVars)) {
            // allow us to reference it by the key
            $$key = $value;
        }
    }

    if (isset($artistid)){
    array_push($whereArr,"artists.id=" . $artistid);
        }
    if (isset($exhib_number)) {
        array_push($whereArr, "exhib_number=" . $exhib_number);
    }
    if (isset($neodada)) {
        array_push($whereArr, "neodada=" . $neodada);
    }
    if (isset($realism)) {
        array_push($whereArr, "realism=" . $realism);
    }
    if (isset($surrealism)) {
        array_push($whereArr, "surrealism=" . $surrealism);
    }
    if (isset($abstractexpress)) {
        array_push($whereArr, "abstractexpress=" . $abstractexpress);
    }
    if (isset($postexpress)) {
        array_push($whereArr, "postexpress=" . $postexpress);
    }
    if (isset($popart)) {
        array_push($whereArr, "popart=" . $popart);
    }
    if (isset($minimal)) {
        array_push($whereArr, "minimal=" . $minimal);
    }
    if (isset($conceptualart)) {
        array_push($whereArr, "conceptualart=" . $conceptualart);
    }
    if (isset($ismuseum)) {
        array_push($whereArr, "ismuseum=" . $ismuseum);
    }
    if (isset($isdrip)) {
        array_push($whereArr, "isdrip=" . $isdrip);
    }
    if (isset($isguggen)) {
        array_push($whereArr, "isguggen=" . $isguggen);
    }
    if (isset($workid)) {
        array_push($whereArr, "works.id=" . $workid);
    }
    if (isset($year_start) && isset($year_end)) {
        array_push($whereArr, "(exhib_year>=" . $year_start . " AND exhib_year<=" . $year_end . ")");
    } elseif (isset($year_start)) {
        array_push($whereArr, "exhib_year>=" . $year_start);
    } elseif (isset($year_end)) {
        array_push($whereArr, "exhib_year>=" . $year_end);
    }
    if (isset($polylimit)){
    $withinpoly = wktFromEscaped($polylimit);
    $withinclause = "ST_Within(st_geomfromtext(the_geom,4326), ".$withinpoly.")";
    array_push($whereArr,$withinclause);
    }
    
    return concatWhere($whereArr);
} // end buildWhere
// function checkOr($value){
// return str_replace("+or+", " OR ", $value);
// }
function wktFromEscaped($wktparam){
$wktguts = urldecode($wktparam);
//only poly for now
//and only 4326
$wkt = "ST_GeomFromText('POLYGON((".$wktguts."))', 4326)";
return $wkt;
}
function concatWhere($whereArr) {
    $where = 'where ';
    $whereA = array();
    foreach ($whereArr as $whereAr) {
        array_push($whereA, " (" . $whereAr . ")");
        // $whereA .= " (".$whereAr.")";
        
    }
    // now let's and it all together
    $numItems = count($whereA);
    $i = 0;
    foreach ($whereA as $value) {
        if ($i + 1 == $numItems) {
            $where.= $value;
        } else {
            $where.= $value . " AND ";
        }
        $i++;
    }
    return $where;
}