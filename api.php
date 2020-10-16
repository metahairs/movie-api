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
        
        if ($movie->read()->exists()) {
            JSONResponse::showKoResponse(
                sprintf('Movie you are trying to create "%s" already exists', $movie->title)
            );
        }
        
        $movie->releaseYear = $_GET['release_year'];
        
        $movie->create(); 
        
        JSONResponse::showOkResponse(
            sprintf('Movie "%s (%d)" created correctly', $movie->title, $movie->releaseYear)
        );

    }

    if ('delete' == $_GET['action']) {
        
        $movie->title = $_GET['title'];   

        if (!$movie->read()->exists()) {
            JSONResponse::showKoResponse(
                sprintf('Movie you are trying to delete "%s" does not exists', $movie->title)
            );
        }
        
        $movie->delete();
        
        JSONResponse::showOkResponse(
            sprintf('Movie "%s (%d)" deleted correctly', $movie->title, $movie->releaseYear)
        );
        
    }
        

    
}catch(PDOException $exception){
    
    JSONResponse::showError($exception->getMessage());
    
}

JSONResponse::showUnknown("Command not found. Try /addmovie/{title}/{releaseYear} or /removemovie/{title}"); 

