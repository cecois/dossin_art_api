<?php
function getFields($outform) {
    //need global app var to set a proper header for actual kml clients later
    global $app;
    //include our models
    include_once 'models/dbfield.php';
    // include other stuff, too
    include_once 'lib/wherebuilder.php';
    $parserpath = 'models/' . $outform . '.php';
    
    switch ($outform) {
        case 'geojson':
            die("Invalid format for this call.");
            break;

        case 'kml':
            die("Invalid format for this call.");
            break;

        case 'debug':
            break;

        default:
            // code...
            break;
    }
    //wrap the whole thing in a try-catch block to catch any wayward exceptions!
    try {
        // include the concatenated parser mode
        include_once $parserpath;
        // set the concatenated output parser
        $outparser = 'pg2' . strtoupper($outform);
        // here a stub of sql to be enrichened by filter params
        $sql="SELECT attname,col_description(attrelid,attnum) as desc,
    pg_catalog.format_type(pg_attribute.atttypid, pg_attribute.atttypmod) as type FROM pg_attribute, pg_class WHERE pg_class.oid = attrelid AND attnum>0 AND relname = 'exhibitions' AND not col_description(attrelid,attnum) IS NULL AND pg_attribute.attrelid = (
        SELECT c.oid
        FROM pg_catalog.pg_class c
            LEFT JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
        WHERE c.relname ~ '^(exhibitions)$'
            AND pg_catalog.pg_table_is_visible(c.oid)
    );";
        
        //execute the action
        $result['data'] = getField($sql);
        $result['success'] = true;
    }
    catch(Exception $e) {
        //catch any exceptions and report the problem
        $result = array();
        $result['success'] = false;
        $result['errormsg'] = $e->getMessage();
    }
    // now go format that stuff

    echo $outparser($sql,$result['data']);
    exit();
}
?>