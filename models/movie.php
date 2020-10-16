<?php

class Movie
{
    
    public $title;
    public $releaseYear;
    
    private $connection;
    
    private $dbTable = 'movies';
    
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

        return $sth;
    }
    
    public function delete()
    {
        $sql = 'DELETE FROM ' . $this->dbTable . ' WHERE title=:title';
       
        $sth = $this->connection->prepare($sql);
       
        $sth->bindParam(":title", $this->title);

        $sth->execute();

        return $sth;
    }
    
    public function read()
    {
        $sql = 'SELECT * FROM ' . $this->dbTable . ' WHERE title=:title';
       
        $sth = $this->connection->prepare($sql);
       
        $sth->bindParam(":title", $this->title);

        $sth->execute();

        return $sth->fetch();
    }
    
        
}