<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

require_once 'php/controllers/DatosController.php';
require_once 'php/services/DatosService.php';
require_once 'php/services/MailService.php';
require_once 'php/database/DbProvider.php';
require_once 'php/models/Dato.php';

use php\controllers\datosController;

$datos = datosController::getAll();


switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
        if(isset($_GET["id"])){
            $datoId = datosController::getIDDat($_GET["id"]);
            $resultado["dato"] = $datoId;
        }else{
            $resultado["datos"] = $datos;
        }
        echo json_encode($resultado);
        break;
    case "POST":
            $_POST = json_decode(file_get_contents('php://input'), true);

            $dat = array(
                "temp" => $_POST["temp"],
                "id_usuario" => $_POST["id_usuario"],
                "pulso" => $_POST["pulso"],
                "pso" => $_POST["pso"],
                "estatus" => $_POST["estatus"],
            );
            

            $creaDatos = datosController::createDatos($dat);

            if($creaDatos == "ok"){
                $resultado["mensaje"] = "Se guardo la siguiente informacion correctamente: ".json_encode($_POST);
                
            }else{
                $resultado["mensaje"] = "Erro: no fue posible almacenar el dato";
            }
            echo $resultado["mensaje"];
        break;
    case "PUT":
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $resultado["mensaje"] =  "Actualizar el usuario con el ID: ".$_GET["id"].
                ", Información a actualizar ".json_encode($_PUT);
             echo json_encode($resultado);
        break;
    case "DELETE":
            $resultado["mensaje"] = "Eliminar el usuario con el ID: ".$_GET["id"];
            echo json_encode($resultado);
        break;
}