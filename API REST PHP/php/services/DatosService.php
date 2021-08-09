<?php
namespace php\services;

use PDOException;
use php\database\DbProvider;
use PDO;

class DatosService{
    
    private $_db;

    public function __construct(){
        $this->_db = DbProvider::get();
    }

    public function getServ(): Array{
        $result = [];

        try {
            
            $stm = $this->_db->prepare('SELECT * FROM datos');
            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_CLASS, '\\php\\models\\Dato');

        } catch (PDOException $th) {
            return 'Ocurrio error de: '.$th;
        }

        return $result;

    }

    public function getDatId($id): Array{
        $result = [];

        try {
            
            $stm = $this->_db->prepare('SELECT * FROM datos WHERE id_usuario = :idD');
            $stm->execute([
                'idD' => $id
            ]);

            $result = $stm->fetchAll(PDO::FETCH_CLASS, '\\php\\models\\Dato');

        } catch (PDOException $th) {
            return 'Ocurrio error de: '.$th;
        }

        return $result;

    }

    public function create($model){
        try {
            
            $stm = $this->_db->prepare(
                'INSERT INTO datos(id_usuario, temp, pulso, pso, fecha, estatus) values(:id_usuario, :temp, :pulso, :pso, NOW(), :estatus)'
            );
            if($stm->execute([
                'id_usuario' => $model->id_usuario,
                'temp' => $model->temp,
                'pulso' => $model->pulso,
                'pso' => $model->pso,
                'estatus' => $model->estatus,
                
            ])){
                return "ok";
            }

        } catch (PDOException $th) {
            echo 'Ocurrio error de: '.$th;
        }
    }

}
