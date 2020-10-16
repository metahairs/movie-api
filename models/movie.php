<?php

class Movie
{
    
    public $title;
    public $releaseYear;
    
    private $connection;
    
    private $dbTable = 'movies';
    
    private $exists;
    
    public function __construct($connection)
    {
        $this->connection = $connection; 
    }
    
    public function create()
    {
        $sql = 'INSERT INTO ' . $this->dbTable . ' SET title=:title, release_year=:release_year';
       
        $sth = $this->connection->prepare($sql);
       
        $sth->bindParam(":title", $this->title);
        $sth->bindParam(":release_year", $this->releaseYear);

        $sth->execute();

    }
    
    public function delete()
    {
        $sql = 'DELETE FROM ' . $this->dbTable . ' WHERE title=:title';
       
        $sth = $this->connection->prepare($sql);
       
        $sth->bindParam(":title", $this->title);

        $sth->execute();

    }
    
    public function read()
    {
        $sql = 'SELECT * FROM ' . $this->dbTable . ' WHERE title=:title';
       
        $sth = $this->connection->prepare($sql);
       
        $sth->bindParam(":title", $this->title);

        $sth->execute();
        
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            
            $this->exists = false;
            
            return $this;
        }
        
        $this->releaseYear = $data['release_year'];
        
        $this->exists = true;
        
        return $this;
        
    }
    
    public function exists()
    {
        return $this->exists;
    }
        
}