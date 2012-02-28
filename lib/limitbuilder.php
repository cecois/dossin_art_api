<?php
function buildLimit($paramarray) {
    $limitClause = '';
    // to prevent injection during what we'll do next, we need to limit valid keys
    $acceptedIncomingVars = array('limit');

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

    if (isset($limit)){
    $limitClause = ' limit '.$limit;
        }

    return $limitClause;
    
} // end buildLimit