<?php

class DB
{
    
    private $config;
    private static $connection = null;
    
    public function __construct($config) 
    {
        $this->config = $config;
        
    }
    
    public function getConnection()
    {
        
        if (!is_null(self::$connection)) {
            return self::$connection;
        }
        
        self::$connection = new PDO(
            'mysql:host='.$this->config['hostname'].';dbname='.$this->config['database'],
            $this->config['username'],
            $this->config['password']
        );
        
        self::$connection->exec("set names utf8");

        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$connection;
    }
}
