<?php
function buildJoin($paramarray) {

/* stub of a join clause */
$joinclau = '';

    // to prevent injection during what we'll do next, we need to limit valid keys
    $acceptedIncomingVars = array('artistid','artistname');
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
    $joinclau .= " join exhibitions_has_artists mm on mm.fk_exhibitions_id=ex.id join artists on mm.fk_artists_id=artists.id ";
        }

    return $joinclau;
}