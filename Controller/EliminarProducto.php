<?php

include("../Models/Producto.php");
include("../Database/Conexion.php");
header('Content-Type: application/json');
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

if(isset($_SERVER['REQUEST_METHOD']))
{
    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            try {


                $idproducto = $_GET['idproducto'];

               

                if($idproducto){
                  $resp = Producto::DeleteById($idproducto);
                  if( $resp  != false ){
                    http_response_code(200);
                        echo json_encode($resp);
                  }else{
                    echo $resp;
                    http_response_code(500);
                    echo json_encode(array("message"=>"Internal Error"));
                  }
                }else{
                  http_response_code(400);
                  echo json_encode(array("message"=>"Bad Request"));
                }
              } catch (Exception $th) {
                http_response_code(500);
                echo json_encode(array("message"=>"Internal Error"));
              } 

            break;
            
            default :
            http_response_code(404);
            echo json_encode(array("message"=>"Resource Not Found "));
    }
}




?>