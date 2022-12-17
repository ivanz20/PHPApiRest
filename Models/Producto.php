<?php

class Producto{

    public static function Save($nombreproducto, $descripcion, $precio, $categoria, $imagen,$iduser){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (1,NULL,'" . $nombreproducto . "','" . $descripcion . "'," . $precio . ",' " . $categoria . "',' " . $imagen ."'," . $iduser . ");");
            
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
            $query = $db->query("CALL SP_PRODUCTOS (2,". $ID .",NULL,NULL,NULL,NULL,NULL,NULL);");
            
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
    
    public static function DeleteById($ID){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (5,". $ID .",NULL,NULL,NULL,NULL,NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                return true;
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
    
    public static function EditProduct($ID,$nombre,$descr,$precio,$categoria,$imagen){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (6,". $ID .",'". $nombre ."','". $descr ."',". $precio .",'". $categoria ."','" . $imagen . "',NULL);");
            
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
    
    public static function FindByUser($ID){
        try{
            $db = Conexion::connect();
            $sql = "CALL SP_PRODUCTOS (4,NULL,NULL,NULL,NULL,NULL,NULL,". $ID .");";
            $query = $db->query($sql);
            
            if($query){
                Conexion::disconnect($db);
                $productos = null;
                $ola = 0;
                while($row = $query->fetch_assoc()) {
                        
                            $productos[]=$row;
                    
              
                     }
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
    
    public static function GetOrderedById(){
        try{
            $db = Conexion::connect();
            $sql = "CALL SP_PRODUCTOS (7,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $query = $db->query($sql);
            
            if($query){
                Conexion::disconnect($db);
                $productos = null;
                $ola = 0;
                while($row = $query->fetch_assoc()) {
                        
                            $productos[]=$row;
                    
              
                     }
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
    
    public static function GetOrderedByCalif(){
        try{
            $db = Conexion::connect();
            $sql = "CALL SP_PRODUCTOS (8,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
            $query = $db->query($sql);
            
            if($query){
                Conexion::disconnect($db);
                $productos = null;
                $ola = 0;
                while($row = $query->fetch_assoc()) {
                        
                            $productos[]=$row;
                    
              
                     }
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

    public static function FindProduct($nombre){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_PRODUCTOS (3,NULL,'" . $nombre . "',NULL,NULL,NULL,NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                $productos = null;
                $ola = 0;
                while($row = $query->fetch_assoc()) {
                        
                            $productos[]=$row;
                    
              
                     }
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