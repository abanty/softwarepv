<?php
require '../config/conexion.php';

Class Modelo{

      public function __construct(){}

      public function registrar($abreviatura,$nombre,$descripcion,$condicion){
        $sql = "INSERT INTO modelo(abreviatura,nombre,descripcion,condicion) VALUES('$abreviatura','$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);
      }

      public function modificar($idmodelo,$abreviatura,$nombre,$descripcion,$condicion){
        $sql = "UPDATE modelo SET abreviatura='$abreviatura',nombre='$nombre',descripcion='$descripcion',condicion='$condicion' WHERE idmodelo='$idmodelo'";
        return ejecutarConsulta($sql);
      }

      public function activar($idmodelo){
        $sql="UPDATE modelo SET condicion='1' WHERE idmodelo = '$idmodelo'";
		    return ejecutarConsulta($sql);
      }

      public function desactivar($idmodelo){
        $sql="UPDATE modelo SET condicion='0' WHERE idmodelo = '$idmodelo'";
  		  return ejecutarConsulta($sql);
      }

      public function listarActivos(){
        $sql="SELECT * FROM modelo
    		WHERE nombre not like '-' AND condicion = 1
    		ORDER BY idmodelo DESC";
    		return ejecutarConsulta($sql);
      }

      public function listarDesactivos(){
        $sql="SELECT * FROM modelo
      	WHERE nombre not like '-' AND condicion = 0
        ORDER BY idmodelo DESC";
        return ejecutarConsulta($sql);
      }

      public function mostrar($idmodelo){
        $sql="SELECT * FROM modelo WHERE idmodelo='$idmodelo'";
		    return ejecutarConsultaSimpleFila($sql);
      }

      public function seleccionarmodelo(){
        $sql="SELECT * FROM modelo WHERE condicion=1";
		    return ejecutarConsulta($sql);
      }

}
?>
