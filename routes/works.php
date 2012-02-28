<?php
function getArtistWorks($artistid,$outform) {
    //need global app var to set a proper header for actual kml clients later
    global $app;
    //include our models
    include_once 'models/work.php';
    // include other stuff, too
    include_once 'lib/wherebuilder.php';
        include_once 'lib/joinbuilder.php';
        include_once 'lib/limitbuilder.php';

    $parserpath = 'models/' . $outform . '.php';
    
    switch ($outform) {

                case 'geojson':
            $sql_st_transform = "st_asgeojson(st_transform(the_geom,4326))";
            break;

        case 'kml':
            $sql_st_transform = "ST_AsKML(st_transform(the_geom,4326))";
            break;

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

$sql ="select works.id as work_id,works.name as work_name,exhib_number,exhib_name,exhib_year,realism,surrealism,abstractexpress,postexpress,neodada,popart,minimal,conceptualart,ismuseum,onlyus,exhib_from_us,
sp.name as exhib_space_name,isguggen,";



 if (!isset($sql_st_transform)) {
            $sql_st_transform = "ST_AsText(st_transform(the_geom,4326))";
        }
        $sql.= $sql_st_transform;

$sql.=' as the_geom,works."year" as work_year from exhibitions_has_works ew ';

        $params = $_REQUEST; 
        // in this case works is a subroute of artist, so we already have an id
        $params["artistid"] = $artistid;
        $joinclause = buildJoinForWorks($params);
        $whereclause = buildWhere($params);
        $limitclause = buildLimit($params);       
        $sql.= $joinclause;
        $sql.= $whereclause;
        $sql.=$limitclause;

// echo $sql;die();

        // $sql.= " and w.fk_artists_id=".$artistid;
        //execute the action
        $result['data'] = getWork($sql);
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