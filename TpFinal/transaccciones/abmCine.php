<?php

include_once './BaseDatos.php';
include_once './cine.php';

class abmCine{

    function buscarId($id){

        $objCine= new cine();
        $objCine->Buscar($id);
        return  $objCine;
    }

// ----------------- funciones modifica
    function modificarNombre_Cine($objCine,$nombre){

        $objCine-> setNombre($nombre);
        $objCine->modificar();
    }


    function modificarHora_Cine($objCine,$hora){

        $objCine-> setHora_inicio($hora);
        $objCine->modificar();
    }


    function modificarDuracion_Cine($objCine,$duracion){

        $objCine-> setDuracion($duracion);
        $objCine->modificar();
    }

    function modificarPrecio_Cine($objCine,$precio){

        $objCine-> setPrecio($precio);
        $objCine->modificar();
    }

    function modificarGenero_Cine($objCine,$genero){

        $objCine-> setGenero($genero);
        $objCine->modificar();
    }


    function modificarPais_Cine($objCine,$paisOrigen){

        $objCine-> setpaisOrigen($paisOrigen);
        $objCine->modificar();
    }
// -----------------------------------------------------------------------

    function crearCine($idFuncion,$objTeatro,$nombre,$hora,$duracion,$precio,$genero,$paisOrigen){

    $objCine= new cine();
    $colCine= $objCine->listar();

    $array= ['idFuncion'=> $idFuncion,'nombreFuncion'=>$nombre,'horaInicio'=>$hora,'duracion'=>$duracion,'precioPublico'=>$precio,'objTeatro'=>$objTeatro,'genero'=>$genero,'paisOrigen'=>$paisOrigen];
    $objCine->cargar($array);
    $resp= $objCine->insertar();
    $colCine= $objCine->listar("");

            if ($resp== true) {
                echo "cine cargado exitosamente....";
                foreach ($colCine as $unCine) {
                    
                    echo "-------------------------------";
                    echo "\n $unCine \n";
                    echo "-------------------------------";
                }

            }else{
                echo "algo fallo";
            }
    }


    function eliminarCine($objCine){

        

            $resp= $objCine->eliminar();
    
            if ($resp==true) {
                echo "\n funcion eliminada...\n";
            }else{
                echo "algo fallo";
            }
    
        
    }


    function mostrarcine(){

        $objcine= new cine();
        $colcine= $objcine->listar("");

        foreach ($colcine as $uncine) {
                    
            echo "-------------------------------";
            echo "\n $uncine \n";
            echo "-------------------------------";
        }


    }


    function darCosto(){

        $objCine= new cine();
        $colCine= $objCine->listar("");
        foreach ($colCine as $unCine) {
            
            echo "\n $unCine \n";
            echo "costo Cine: ". $unCine->darCosto();
        }
       
    }

}