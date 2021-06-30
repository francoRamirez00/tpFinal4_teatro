
<?php

include_once './BaseDatos.php';
include_once './musical.php';

class abmMusical{

    function buscarId($id){

        $objMusical= new musical();
        $objMusical->Buscar($id);
        return  $objMusical;
    }

// ----------------- funciones modifica
    function modificarNombre_Musical($objMusical,$nombre){

        $objMusical-> setNombre($nombre);
        $objMusical->modificar();
    }


    function modificarHora_Musical($objMusical,$hora){

        $objMusical-> setHora_inicio($hora);
        $objMusical->modificar();
    }


    function modificarDuracion_Musical($objMusical,$duracion){

        $objMusical-> setDuracion($duracion);
        $objMusical->modificar();
    }

    function modificarPrecio_Musical($objMusical,$precio){

        $objMusical-> setPrecio($precio);
        $objMusical->modificar();
    }

    function modificarDirector_Musical($objMusical,$director){

        $objMusical-> setdirector($director);
        $objMusical->modificar();
    }


    function modificarCant_Musical($objMusical,$cantPersonas){

        $objMusical-> setcantidadPersonas($cantPersonas);
        $objMusical->modificar();
    }
// -----------------------------------------------------------------------

    function crearMusical($idFuncion,$objTeatro,$nombre,$hora,$duracion,$precio,$director,$cantPersonas){

    $objMusical= new musical();
    $colMusical= $objMusical->listar();

    $array= ['idFuncion'=> $idFuncion,'nombreFuncion'=>$nombre,'horaInicio'=>$hora,'duracion'=>$duracion,'precioPublico'=>$precio,'objTeatro'=>$objTeatro,'director'=>$director,'cantPersonas'=>$cantPersonas];
    $objMusical->cargar($array);
    $resp= $objMusical->insertar();
    $colMusical= $objMusical->listar("");

            if ($resp== true) {
                echo "muscial cargado exitosamente....";
                foreach ($colMusical as $unMusical) {
                    
                    echo "-------------------------------";
                    echo "\n $unMusical \n";
                    echo "-------------------------------";
                }

            }else{
                echo "algo fallo";
            }
    }

    function mostrarMusical(){

        $objMusical= new musical();
        $colMusical= $objMusical->listar("");

        foreach ($colMusical as $unMusical) {
                    
            echo "-------------------------------";
            echo "\n $unMusical \n";
            echo "-------------------------------";
        }


    }


    function eliminarMusical($objMusical){

        

            $resp= $objMusical->eliminar();
    
            if ($resp==true) {
                echo "\n funcion eliminada...\n";
            }else{
                echo "algo fallo";
            }
    
        
    }


    function darCosto(){

        $objMusical= new musical();
        $colMusical= $objMusical->listar("");
        foreach ($colMusical as $unMusical) {
            
            echo "\n $unMusical \n";
            echo "costo Musical: ". $unMusical->darCosto();
        }
       
    }

}