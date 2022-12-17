<?php

include("../Models/Comentario.php");
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

        case 'POST':
            try {

                $json = file_get_contents('php://input');
                $data = json_decode($json);

                $idproducto = $data->idproducto;
                $iduser = $data->iduser;
                $comentario = $data->comentario;
                $username = $data->username;
                $calificacion = $data->calificacion;

                if($idproducto && $iduser && $comentario && $username ){
                  $resp = Comentario::Save($idproducto, $iduser, $comentario, $username, $calificacion);
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

            case 'GET':
                try {
    
                   $idproducto = $_GET['idproducto'];
    
                    if($idproducto){
                      $resp = Comentario::FindCommentByProductID($idproducto);
                      if( $resp  != false ){
                        http_response_code(200);
                        echo json_encode(utf8ize($resp));
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