<?php
function getExhibitions($outform) {
    //need global app var to set a proper header for actual kml clients later
    global $app;
    //include our models
    include_once 'models/exhibition.php';
    // include other stuff, too
    include_once 'lib/wherebuilder.php';
    include_once 'lib/joinbuilder.php';
    $parserpath = 'models/' . $outform . '.php';
    
    switch ($outform) {
        case 'geojson':
            $sql_st_transform = "st_asgeojson(st_transform(the_geom,4326))";
            break;

        case 'kml':
            $sql_st_transform = "ST_AsKML(st_transform(the_geom,4326))";
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
        $sql = "SELECT exhib_number,exhib_name,exhib_year,realism,surrealism,abstractexpress,postexpress,neodada,popart,minimal,conceptualart,ismuseum,onlyus,exhib_from_us,";
        if (!isset($sql_st_transform)) {
            $sql_st_transform = "ST_AsText(st_transform(the_geom,4326))";
        }
        $sql.= $sql_st_transform;
        $sql.= " as the_geom from exhibitions as ex join exhibition_spaces on ex.fk_exhibition_spaces_id=exhibition_spaces.id join cities on exhibition_spaces.fk_cities_id=cities.id ";
        //get all of the parameters in the POST/GET request
        $params = $_REQUEST;
        $joinclause = buildJoin($params);
        $whereclause = buildWhere($params);
        $sql.= $joinclause;
        $sql.= $whereclause;
        // }
        //execute the action
        $result['data'] = getExhibition($sql);
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