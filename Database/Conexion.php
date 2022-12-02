<?php

class Conexion{

    public static function connect(){
        $settings = require_once("../config.php");
        $DBHost = $settings["dbHost"];
        $DBName = $settings["dbName"];
        $DBUser = $settings["dbUser"];
        $DBPass = $settings["dbPass"];

        $mysqli = new mysqli($DBHost,$DBUser,$DBPass,$DBName);
        if($mysqli->connect_errno){
            echo "Problema con la conexion a la base de datos";
        }
        return $mysqli;
    }

    
    public static function disconnect($mysqli){
        mysqli_close($mysqli);
    }

}


?>