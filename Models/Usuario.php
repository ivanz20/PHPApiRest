<?php

class User {

    public static function Save($nombre, $apellido, $email, $password, $telefono, $imagen){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_USUARIO (1,NULL,'" . $nombre . "','" . $apellido . "','" . $email . "','" . $password ."',' " . $telefono . "',' " . $imagen ."');");
            
            if($query){
                Conexion::disconnect($db);
                $user = $query->fetch_assoc();
                return $user;             }
            else{
                Conexion::disconnect($db);
                return false;
            }
            return true;
        }
            catch(Exception $e){
                return false;
        }
            Conexion::disconnect($db);
    }

    public static function Update($nombre, $password, $imagen, $id){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_USUARIO (2," . $id .",'" . $nombre . "',NULL,NULL,'" . $password ."',NULL,' " . $imagen ."');");
            
            if($query){
                Conexion::disconnect($db);
                $user = $query->fetch_assoc();
                return $user;   
            }
            else{
                echo $db->error;
                Conexion::disconnect($db);
                return false;
            }
            return true;
        }
            catch(Exception $e){
                echo $e;
                return false;
        }
            Conexion::disconnect($db);
    }


    public static function Auth($email, $password){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_USUARIO (3,NULL,NULL,NULL,'". $email . "','" . $password ."',NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                $user = $query->fetch_assoc();
                return $user;
            }
            else{
                echo $db->error;
                Conexion::disconnect($db);
                return false;
            }
            return true;
        }
            catch(Exception $e){
                echo $e;
                return false;
        }
            Conexion::disconnect($db);
    }



}


?>