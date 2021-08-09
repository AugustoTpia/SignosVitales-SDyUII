<?php
namespace php\database;

use PDO;

class DbProvider{

    private static $_db;

    public static function get(){

        if(!self::$_db){

            $pdo = new PDO(
                'mysql:host=localhost;dbname=sdyu;charset=utf8',
                'root',
                'root'
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            self::$_db = $pdo;
            
        }

        return self::$_db;
    }

}