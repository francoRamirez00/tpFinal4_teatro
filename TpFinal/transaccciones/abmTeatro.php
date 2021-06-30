<?php 

include_once 'BaseDatos.php';
include_once 'teatro.php';

class abmTeatro{

        function modificarNombre($objTeatro,$nombre){

            $objTeatro->setNombreTeatro($nombre);
            $objTeatro->modificar();

            $colTeatro=$objTeatro->listar("");
            foreach ($colTeatro as $unT) {
                    
                echo "\n $unT \n";
            }
        }

        function modificarDireccion($objTeatro,$direccion){
            
            $objTeatro->setDireccionTeatro($direccion);
            $objTeatro->modificar();

            $colTeatro=$objTeatro->listar("");
            foreach ($colTeatro as $unT) {
                    
                echo "\n $unT \n";
            }
            
        }


        function buscarId($id){

            $objTeatro= new Teatro();
            $objTeatro->Buscar($id);
            return $objTeatro;
        }


        function mostrarInfo_teatro($objTeatro){

            echo "\n------------------ info teatro ------------------ \n";
            echo "\n $objTeatro \n";
            echo "\n------------------ info teatro fin ------------------ \n";

        }

        function crearTeatro($idTeatro,$nombre,$direccion,$coleccion){

        $objTeatro= new Teatro();
        $colTeatro= $objTeatro->listar();

        $objTeatro->cargar($idTeatro,$nombre,$direccion,$coleccion);
        $resp= $objTeatro->insertar();
        $colTeatro=$objTeatro->listar("");

            if ($resp== true) {
                echo "teatro cargado exitosamente....";
                foreach ($colTeatro as $unT) {
                    
                    echo "\n $unT \n";
                }

            }else{
                echo "algo fallo";
            }

        // $colTeatro= $objTeatro->listar("");
        // echo $objTeatro;
       

        }

        function eliminarTeatro($objTeatro){


            $arreglo= $objTeatro->getFunciones_teatro();

            foreach ($arreglo as $funcion) {
                $funcion->eliminar();
            }

            $resp= $objTeatro->eliminar();
            $colTeatro=$objTeatro->listar("");

            if ($resp==true) {
                echo "teatro eliminado...";
                echo"------------------------------------------------\n";
                foreach ($colTeatro as $unT) {
                    
                    echo "\n $unT \n";
                }
            }else{
                echo "algo fallo";
            }
        }


        function chequeoHorario($objTeatro,$nuevahora, $nuevaDuracion){

           $finNuevoHorario= $nuevahora+($nuevaDuracion);
            $i = 0 ;
            $retorno = false ;
            $Funcion = $objTeatro-> getFunciones_teatro();

            // if ($Funcion[$i]!== null) {
                 do {
                    $hsInicio= $Funcion[$i]->getHora_inicio();
                   $duracion= $Funcion[$i]->getDuracion();
                   $finFuncion= $hsInicio+ $duracion;
                   
                   if (($nuevahora < $hsInicio && $finNuevoHorario < $hsInicio) || ( $nuevahora > $finFuncion && $finNuevoHorario > $finFuncion)) {
                       $retorno = true;
                       
                   }else {
                       $i++;
                   }
                   
                //     if (  ($nuevahora <= $finFuncion && $hsInicio >= $nuevahora  )&&($hsInicio!= $nuevahora) && ($nuevahora >= $hsInicio && $finNuevoHorario >=  $finFuncion) )  {
                
                //         $retorno = true ;
                //     } else {
                       
                //         $i++;
                //     }
               
                } while ($retorno == false &&$i<count( $Funcion) ) ;
            // }
           
           
            return $retorno ;
            
    
        }


        function funcionesMostrar(){

            $objTeatro=new Teatro();
            $col =$objTeatro->getFunciones_teatro();

            foreach ($col as $funcion) {
                
                $funcion;
            }
        }


        

}


?>