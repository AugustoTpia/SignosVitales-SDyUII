<?php
namespace php\controllers;

use php\services\DatosService;
use php\services\ModeloEnvMail;
use php\models\Dato;

class datosController{

    public static function getAll(){

        $evento = new DatosService;

        $result = $evento->getServ();
        
        return $result;
    }

    public static function getIDDat($id){

        $datosId = new DatosService;

        $result = $datosId->getDatId($id);

        return $result;
    }

    public static function createDatos($data){

        $dato = new DatosService;

        $model = new Dato;
        $model->id_usuario = $data["id_usuario"];
        $model->temp = $data["temp"];
        $model->pulso = $data["pulso"];
        $model->pso = $data["pso"];
        $model->estatus = $data["estatus"];

        $result = $dato->create($model);

        ModeloEnvMail::mdlEnviaMail();

        return $result;

    }

}

