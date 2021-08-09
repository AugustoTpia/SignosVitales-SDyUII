<?php
header('Content-Type: application/json');

require_once 'php/controllers/usuarioController.php';
require_once 'php/services/UsuarioService.php';
require_once 'php/database/DbProvider.php';
require_once 'php/models/Usuario.php';

use php\controllers\usuarioController;

$users = usuarioController::getAll();


switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
        if(isset($_GET["id"])){
            $resultado["mensaje"] = "Retornar usuario con ID: ".$_GET["id"];
        }else{
            $resultado["usuarios"] = $users;
        }
        echo json_encode($resultado);
        break;
    case "POST":
            $_POST = json_decode(file_get_contents('php://input'), true);
            $resultado["mensaje"] = "Guardar usuario, informacion: ".json_encode($_POST);
            echo json_encode($resultado);
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