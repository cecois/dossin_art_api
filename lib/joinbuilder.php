<?php
function buildJoinForExhibitions($paramarray) {

/* stub of a join clause */
$joinclau = '';

    // to prevent injection during what we'll do next, we need to limit valid keys
    $acceptedIncomingVars = array('artistid','artistname','isdrip');
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
    // if (isset($artistid)){
    // $joinclau .= " join exhibitions_has_artists exa on exa.fk_exhibitions_id=ex.id join artists on exa.fk_artists_id=artists.id ";
    //     }

if (isset($artistid)){
    $joinclau .= " right join exhibitions_has_artists exa on ex.id=exa.fk_exhibitions_id join artists on exa.fk_artists_id=artists.id ";
        }        

    $joinclau .= " join exhibition_spaces on ex.fk_exhibition_spaces_id=exhibition_spaces.id join cities on exhibition_spaces.fk_cities_id=cities.id join countries on cities.fk_countries_id=countries.id ";
        //get all of the parameters in the POST/GET request"    
    return $joinclau;
}

function buildJoinForWorks($paramarray) {

/* stub of a join clause */
$joinclau = '';

    // to prevent injection during what we'll do next, we need to limit valid keys
    $acceptedIncomingVars = array('artistid');
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
    $joinclau .=' join exhibitions ex on ew.fk_exhibitions_id=ex.id
    join exhibition_spaces sp on ex.fk_exhibition_spaces_id=sp.id
    join cities on sp.fk_cities_id=cities.id
    join works on ew.fk_works_id=works."id"
    join artists on works.fk_artists_id=artists.id ';
        }

    return $joinclau;
}