<?php

include_once './BaseDatos.php';
include_once './obraTeatro.php';

class abmObraTeatro{

    function buscarId($id){

        $objObraTeatro= new obraTeatro();
        $objObraTeatro->Buscar($id);
        return  $objObraTeatro;
    }

// ----------------- funciones modifica
    function modificarNombre_obra($objObraTeatro,$nombre){

        $objObraTeatro-> setNombre($nombre);
        $objObraTeatro->modificar();
    }


    function modificarHora_obra($objObraTeatro,$hora){

        $objObraTeatro-> setHora_inicio($hora);
        $objObraTeatro->modificar();
    }


    function modificarDuracion_obra($objObraTeatro,$duracion){

        $objObraTeatro-> setDuracion($duracion);
        $objObraTeatro->modificar();
    }

    function modificarPrecio_obra($objObraTeatro,$precio){

        $objObraTeatro-> setPrecio($precio);
        $objObraTeatro->modificar();
    }
// -----------------------------------------------------------------------
    

    function crearObra($idFuncion,$objTeatro,$nombre,$hora,$duracion,$precio){

    $objObraTeato= new obraTeatro();
    $colObraTeato= $objObraTeato->listar();

    $array= ['idFuncion'=> $idFuncion,'nombreFuncion'=>$nombre,'horaInicio'=>$hora,'duracion'=>$duracion,'precioPublico'=>$precio,'objTeatro'=>$objTeatro,];
    $objObraTeato->cargar($array);
    $resp= $objObraTeato->insertar();
    $colObraTeato= $objObraTeato->listar("");

        if ($resp== true) {
            echo "obra cargado exitosamente....";
            foreach ($colObraTeato as $unaObra) {
                
                echo "-------------------------------";
                echo "\n $unaObra \n";
                echo "-------------------------------";
            }

        }else{
            echo "algo fallo";
        }
    }

    function eliminarObra($objObraTeatro){

        $resp= $objObraTeatro->eliminar();

        if ($resp==true) {
            echo "\n funcion eliminada...\n";
        }else{
            echo "algo fallo";
        }

    }

    function mostrarObra(){

        $objObra= new cine();
        $colObra= $objObra->listar("");

        foreach ($colObra as $unaObra) {
                    
            echo "-------------------------------";
            echo "\n $unaObra \n";
            echo "-------------------------------";
        }


    }

    function darCosto(){

        $objObra= new obraTeatro();
        $colObra= $objObra->listar("");
        foreach ($colObra as $unObra) {
            
            echo "\n $unObra \n";
            echo "costo Obra: ". $unObra->darCosto();
        }
       
    }



}
?>