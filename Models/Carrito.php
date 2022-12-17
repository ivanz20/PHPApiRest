<?php

class Carrito{

    public static function Save($talla, $color, $imagen, $nombreproducto, $precio, $iduser){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_CARRITO (1,NULL,'" . $talla . "','" . $color . "','" . $imagen . "',' " . $nombreproducto . "'," . $precio ."," . $iduser . ");");
            
            if($query){
                Conexion::disconnect($db);
                return "Producto Agregado Al Carrito";
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


    public static function FindProductsByUserID($ID){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_CARRITO (2,NULL,NULL,NULL,NULL,NULL,NULL,". $ID .");");
            
            if($query){
                Conexion::disconnect($db);
                $productosCarrito = $query->fetch_all();
                return $productosCarrito;
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


    public static function DeleteFromCart($ID){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_CARRITO (3," . $ID . ",NULL,NULL,NULL,NULL,NULL,NULL);");
            
            if($query){
                Conexion::disconnect($db);
                return "Producto Eliminado Del Carrito";
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


    public static function BuyCart($iduser){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_CARRITO (4,NULL,NULL,NULL,NULL,NULL,NULL," . $iduser .");");
            
            if($query){
                Conexion::disconnect($db);
                return "Carrito Comprado";
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