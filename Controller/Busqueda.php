<?php

include("../Models/Producto.php");
include("../Database/Conexion.php");
header('Content-Type: application/json');


if(isset($_SERVER['REQUEST_METHOD']))
{
    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            try {

                $json = file_get_contents('php://input');
                $data = json_decode($json);

                $nombre = $data->nombre;
               

                if($nombre){
                  $resp = Producto::FindProduct($nombre);
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