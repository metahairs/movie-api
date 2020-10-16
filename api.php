<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$configDB = require __DIR__ .'/includes/config.php';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/models/movie.php';
require __DIR__ . '/utils/jsonResponse.php';


try {
    
    $db = new DB($configDB);
    $dbConnection = $db->getConnection();

    $movie = new Movie($dbConnection);

    if ('create' == $_GET['action'] ) {

        $movie->title = $_GET['title'];
        $movie->releaseYear = $_GET['release_year'];
        
        
        JSONResponse::showOkResponse($movie->create());

    }

    if ('delete' == $_GET['action']) {
        
        $movie->title = $_GET['title'];       
        $movie->delete();
        
        JSONResponse::showOkResponse('Movie deleted');
        
    }

    
}catch(PDOException $exception){
    
    JSONResponse::showError($exception->getMessage());
    
}

JSONResponse::showUnknown('Command not found'); 

