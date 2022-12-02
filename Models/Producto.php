<?php

class Producto{

    public static function Save($nombreproducto, $descripcion, $precio, $categoria, $imagen){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (1,NULL,'" . $nombreproducto . "','" . $descripcion . "'," . $precio . ",' " . $categoria . "',' " . $imagen ."');");
            
            if($query){
                Conexion::disconnect($db);
                $producto = $query->fetch_assoc();
                return $producto; 
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


    public static function FindById($ID){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (2,". $ID .",NULL,NULL,NULL,NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                $producto = $query->fetch_assoc();
                return $producto;
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

    public static function FindProduct($nombre){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (3,NULL,'" . $nombre . "',NULL,NULL,NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                $productos = $query->fetch_all();
                return $productos;
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