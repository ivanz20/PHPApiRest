<?php

class Comentario{

    public static function Save($idproducto, $iduser, $comentario, $usuario, $calificacion){
        try{
            $db = Conexion::connect();
            $eso = "CALL SP_COMENTARIOS (1,". $idproducto .",". $iduser .",'" . $comentario . "','". $usuario ."'," . $calificacion.");";
                                
            $query = $db->query($eso);
            
             if($query){
                Conexion::disconnect($db);
                $comentario = $query->fetch_assoc();
                return $comentario;
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


    public static function FindCommentByProductID($ID){
        try{
            $db = Conexion::connect();
            $query = $db->query("CALL SP_COMENTARIOS (2,". $ID .", NULL, NULL,NULL,NULL);");
            
            if($query){
               Conexion::disconnect($db);
                $comentarios = null;
                while($row = $query->fetch_assoc()) {
                        
                            $comentarios[]=$row;
                    
              
                     }
                return $comentarios;
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