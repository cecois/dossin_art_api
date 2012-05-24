<?php

require 'Slim/Slim.php';
$app = new Slim();

function debugMe(){
// header("Content-Type: application/xml");
// $app->response()->header('Content-Type', 'application/xml');
echo "debugged?";
}

function describeAPI(){
$content = file_get_contents('views/index.php');
echo $content;
}

function presentAdmin(){
$content = file_get_contents('views/admin.php');
echo $content;
}

require_once 'routes/routes.php';
require_once 'lib/db.php';
require_once 'routes/describeapi.php';

$app->get('/artists/:artistid/works/:outform','getArtistWorks');
$app->get('/dbfields/:outform','getFields');

 // Routes
	//  Artists
	$app->get('/artists/:outform', 'getArtists');
	$app->get('/artistPut/:artist/:outform', 'putArtist');
	
	//  Exhibitions
	$app->get('/exhibitions/:outform','getExhibitions');

	//  Works
	$app->get('/works/:outform','getWorks');

	//  Exhibition Spaces
	$app->get('/spaces/:outform','getExhibitionSpaces');

	//  Cities
	$app->get('/cities/:outform','getCities');

	//  Countries
	$app->get('/countries/:outform', 'getCountries');

	//  Fields and Filters
	$app->get('/valids/:entity/:outform','getValids');
	$app->get('/filters/:entity/:outform','getFilters');

 
//GET route
$app->get('/', 'describeAPI');
$app->get('/admin','presentAdmin');
$app->run();