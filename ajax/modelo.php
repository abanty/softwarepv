<?php

require_once '../models/Modelo.php';


$model = new Modelo();


$idmodelo=isset($_POST["idmodelo"])? limpiarCadena($_POST["idmodelo"]):"";
$abreviatura=isset($_POST["abreviatura"])? limpiarCadena($_POST["abreviatura"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";


switch ($_GET["op"]){


   case 'guardaryeditar':

       if (empty($idmodelo)){
         $rspta=$model->registrar($abreviatura,$nombre,$descripcion,$condicion);
         echo $rspta ? "Modelo agregado" : "Modelo no se pudo agregar";
       }
       else {
         $rspta=$model->modificar($idmodelo,$abreviatura,$nombre,$descripcion,$condicion);
         echo $rspta ? "Modelo actualizado" : "Modelo no se pude actualizar";
       }

   break;


    case 'desactivar':

       $rspta=$model->desactivar($idmodelo);
       echo $rspta ? "Modelo desactivado" : "Modelo no se pudo desactivar";

    break;


    case 'activar':

       $rspta=$model->activar($idmodelo);
       echo $rspta ? "Modelo activado" : "Modelo no se pudo activar";

    break;


    case 'mostrar':

       $rspta=$model->mostrar($idmodelo);
       echo json_encode($rspta);

    break;

    case 'listarAct':

       $rspta=$model->listarActivos();
       $data= Array();

         while ($reg=$rspta->fetch_object()){

             $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-success btn-sm" onclick="mostrar('.$reg->idmodelo.')"><i class="fa fa-pencil"></i></button>'.
               ' <button class="btn btn-danger btn-sm" onclick="desactivar('.$reg->idmodelo.')"><i class="fa fa-close"></i></button>' :  '<button class="btn btn-success btn-sm" onclick="mostrar('.$reg->idmodelo.')"><i class="fa fa-pencil"></i></button>'.
               ' <button class="btn btn-warning btn-sm" onclick="activar('.$reg->idmodelo.')"><i class="fa fa-check"></i></button>',
               "1"=>'<span style="letter-spacing: 0.5px; font-weight: bold; text-transform: uppercase;">'.$reg->abreviatura.'</span>',
               "2"=>'<span style="letter-spacing: 0.5px; font-weight: bold; text-transform: uppercase;">'.$reg->nombre.'</span>',
               "3"=>$reg->descripcion,
               "4"=>($reg->condicion)?'<span class="label bg-olive">Activado</span>' :  '<span class="label bg-red">Desactivado</span>'
               );

        }

       $results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);

      echo json_encode($results);

 break;


}
?>
