<?php
function getArtists($outform) {
    //need global app var to set a proper header for actual kml clients later
    global $app;
    //include our models
    include_once 'models/artist.php';
    // include other stuff, too
    include_once 'lib/wherebuilder.php';
    $parserpath = 'models/' . $outform . '.php';
    
    switch ($outform) {
        case 'json':
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
        $sql = "select * from artists ";

        //execute the action
        $result['data'] = getArtist($sql);
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