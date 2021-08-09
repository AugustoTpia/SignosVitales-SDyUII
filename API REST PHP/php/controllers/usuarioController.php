<?php
namespace php\controllers;

use php\services\UsuarioService;

class usuarioController{

    public static function getAll(){

        $evento = new UsuarioService;

        $result = $evento->getUs();
        
        return $result;
    }

}

