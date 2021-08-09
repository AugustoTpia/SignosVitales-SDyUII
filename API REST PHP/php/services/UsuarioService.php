<?php
namespace php\services;

use PDOException;
use php\database\DbProvider;
use PDO;

class UsuarioService{
    
    private $_db;

    public function __construct(){
        $this->_db = DbProvider::get();
    }

    public function getUs(): Array{
        $result = [];

        try {
            
            $stm = $this->_db->prepare('SELECT * FROM usuarios');
            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_CLASS, '\\php\\models\\Usuario');

        } catch (PDOException $th) {
            return 'Ocurrio error de: '.$th;
        }

        return $result;

    }

}
