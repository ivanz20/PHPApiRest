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
function utf8izent($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8izent($v);
            }
        } else if (is_string ($d)) {
            return utf8_decode($d);
        }
        return $d;
    }
    

if(isset($_SERVER['REQUEST_METHOD']))
{
    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            try {
               

                $dale = true;
                if($dale){
                  $resp = Producto::GetOrderedByCalif();
                  if($resp){
                    http_response_code(200);
                        echo json_encode(utf8ize($resp));
                  }else{
                    http_response_code(500);
                    echo json_encode(array("message"=>"Internal Error"));
                  }
                }else{
                  http_response_code(400);
                  echo json_encode(array("message"=>$data));
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