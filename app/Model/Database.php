<?php
/*
* Database connection class using pdo object 
* and singleton pattern
*/
// namespace App\Model;
// use \PDO;

class Database
{
    private static $connection;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect($host, $user, $password, $database)
    {
        if (!isset(self::$connection))
        {
                self::$connection = @new PDO(
                        "mysql:host=$host;dbname=$database",
                        $user,
                        $password,
                        self::$settings
                );
        }
    }
    
    //retrieve a row from database 
    public static function findOne($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }
    
    //retrieve all rows 
    public static function findAll($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetchAll();
    }

    //retreve a single value from row
    public static function findSingle($query, $params = array())
    {
        $result = self::findOne($query, $params);
        if (!$result)
            return false;
        return $result[0];
    }

}