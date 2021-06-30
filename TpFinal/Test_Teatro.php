<?php 

include_once 'BaseDatos.php';
include_once 'transaccciones/abmTeatro.php';
include_once 'transaccciones/abmMusical.php';
include_once 'transaccciones/abmObraTeatro.php';
include_once 'transaccciones/abmCine.php';


// $colFunciones= [];

// $objTeatro= new abmTeatro();
// $objTeatro->crearTeatro(12,"teatro precargado","nose 567",$colFunciones);

// $objMusical= new abmMusical();
// $objMusical->crearMusical(1,$objTeatro,"funcion 1",16,30,670,"nadie",100);



echo "\n -----------   MENU DEL TEATRO    -----------\n";
echo "bienvenido al Teatro ". "\n" ;



do {
    echo "\n elija una opcion-------\n";
    echo "      \n-1)crear teatro " ;
    echo "      \n-2)eliminar teatro" ;
    echo "      \n-3)cambiar nombre del teatro ";
    echo "      \n-4)cambiar la direccion del teatro";
    echo "      \n-5)cargar funcion";
    echo "      \n-6)cambiar datos a una funcion";
    echo "      \n-7) eliminar funcion " ;
    echo "      \n-8) info teatro " ;
    echo "      \n-9) costos por usar el teatro " ;
    echo "      \n-10) salir " ;
    echo "      \n opcion: ";
    echo "--------------------------------------------------------\n";
    $eleccion = trim(fgets(STDIN)) ;

    switch ($eleccion) {

        case '1':
               
                echo  "nombre : ";
                $nombreT= trim(fgets(STDIN));
                echo "direccion: ";
                $direccionT= trim(fgets(STDIN));
                echo "id Teatro: ";
                $idT= trim(fgets(STDIN));
                echo "------------------------------------------------\n";
                
                $colFunciones=[];

                $objTeatro= new abmTeatro();
                $objTeatro->crearTeatro($idT,$nombreT,$direccionT,$colFunciones);

            break;
    
        case '2':

                echo "id del teatro a eliminar: ";
                echo "------------------------------------------------\n";
                $idT=trim(fgets(STDIN));
                $objTeatro= new abmTeatro();
                $teatro=$objTeatro->buscarId($idT);
                $objTeatro->eliminarTeatro( $teatro);


            break;

        case '3':
                echo "id del teatro a modificar: ";
                $idT=trim(fgets(STDIN));
                echo "ingrese nuevo nombre de teatro : "  ;
                $nuevoNombre_Teatro = trim(fgets(STDIN)) ;
                echo "Cargando nombre del teatro .   .   .  . ". "\n" ;
                $objTeatro= new abmTeatro();
                $teatro= $objTeatro->buscarId($idT);
                $objTeatro->modificarNombre($teatro,$nuevoNombre_Teatro);
                    

            break;
    
        case '4':

                echo "id del teatro a modificar: ";
                $idT=trim(fgets(STDIN));
                echo "ingrese nueva direccion de teatro : "  ;
                $nuevaDireccion_Teatro = trim(fgets(STDIN)) ;
                echo "Cargando direccion al teatro .   .   .  . ". "\n" ;
                $objTeatro= new abmTeatro();
                $teatro= $objTeatro->buscarId($idT);
                $objTeatro->modificarDireccion($teatro,$nuevaDireccion_Teatro);
        
            break ;

        case '5':
            echo "id del teatro: ";
            $idT=trim(fgets(STDIN));

            $objTeatro= new abmTeatro();
            $teatro=$objTeatro->buscarId($idT);

            echo "id de la funcion  ";
            $idF=trim(fgets(STDIN));

            echo "ingrese nombre de la nueva funcion: " ;
            $nombreNuevo_Funcion = trim(fgets(STDIN)) ;
            $validez=false;
            
            do{
                echo "hora de inicio(h.m): ";
                $horaInicio= trim(fgets(STDIN)); 
                echo "duracion(h.m): ";
                $duracion= trim(fgets(STDIN));

                $validez=$objTeatro->chequeoHorario($teatro,$horaInicio,$duracion);

            } while($validez== false);
            

           
            echo "precio: ";
            $precio=trim(fgets(STDIN));

            echo "tipo Funcion(musical, cine, obra): ";
            $tipoFuncion= trim(fgets(STDIN));

            if ($tipoFuncion== "musical") {
                
                echo "director: ";
                $director= trim(fgets(STDIN));
                echo "cant Personas: ";
                $cantPersonas=trim(fgets(STDIN));

                $objMusical= new abmMusical();
                $objMusical->crearMusical($idF,$teatro,$nombreNuevo_Funcion,$horaInicio,$duracion,$precio,$director,$cantPersonas);
                // $objTeatro->coleccionObjetos($objMusical);

            }elseif ($tipoFuncion == "cine") {
                
                echo "genero: ";
                $genero= trim(fgets(STDIN));
                echo "pais Origen: ";
                $pais=trim(fgets(STDIN));

                $objCine= new abmCine();
                $objCine->crearCine($idF,$teatro,$nombreNuevo_Funcion,$horaInicio,$duracion,$precio, $genero,$pais);
                // $objTeatro->coleccionObjetos($objCine);

            }elseif ($tipoFuncion == "obra") {
               
                $objObra= new abmObraTeatro();
                $objObra->crearObra($idF,$teatro,$nombreNuevo_Funcion,$horaInicio,$duracion,$precio);
                // $objTeatro->coleccionObjetos($objObra);
            
            }

            
            
            
           
            


        break;
            
        case '6':

            echo "\n ir a / 1-musical / 2-cine / 3- obra: ";
            $opc= trim(fgets(STDIN));

            if ($opc== 1) {

                $objMusical= new abmMusical();
                echo "\n 1) cambiar nombre: ";
                echo "\n 2) cambiar precio: ";
                echo "\n 3) cambiar horario: ";
                echo "\n 4) cambiar duracion: ";
                echo "\n 5) cambiar director: ";
                echo "\n 6) cambiar cantidad de personas: ";
                $resp= trim(fgets(STDIN));

                    if ($resp== 1) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n nombre nuevo: ";
                        $nom= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarNombre_Musical($musical,$nom);

                    }elseif ($resp== 2) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n  precio nuevo: ";
                        $precio= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarPrecio_Musical($musical,$precio);
                    }elseif ($resp== 3) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n horario nuevo: ";
                        $hora= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarHora_Musical($musical,$hora);
                    }elseif ($resp== 4) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n duracion nueva: ";
                        $duracion= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarDuracion_Musical($musical,$duracion);
                    }elseif ($resp== 5) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n director nuevo: ";
                        $director= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarDirector_Musical($musical,$director);
                    }elseif ($resp== 6) {
                        
                        $objMusical->mostrarMusical();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n cant personas nuevas: ";
                        $cantP= trim(fgets(STDIN));
                        $musical= $objMusical->buscarId($idF);
                        $objMusical->modificarCant_Musical($musical,$cantP);
                    }

            }elseif ($opc== 2) {
               
                $objCine= new abmCine();
                echo "\n 1) cambiar nombre: ";
                echo "\n 2) cambiar precio: ";
                echo "\n 3) cambiar horario: ";
                echo "\n 4) cambiar duracion: ";
                echo "\n 5) cambiar genero: ";
                echo "\n 6) cambiar pais: ";
                $resp= trim(fgets(STDIN));

                    if ($resp== 1) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n nombre nuevo: ";
                        $nom= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarNombre_Cine($Cine,$nom);

                    }elseif ($resp== 2) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n  precio nuevo: ";
                        $precio= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarPrecio_Cine($Cine,$precio);
                    }elseif ($resp== 3) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n horario nuevo: ";
                        $hora= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarHora_Cine($Cine,$hora);
                    }elseif ($resp== 4) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n duracion nueva: ";
                        $duracion= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarDuracion_Cine($Cine,$duracion);
                    }elseif ($resp== 5) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n genero nuevo: ";
                        $genero= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarGenero_Cine($Cine,$genero);
                    }elseif ($resp== 6) {
                        
                        $objCine->mostrarcine();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n pais nuevo: ";
                        $cantP= trim(fgets(STDIN));
                        $Cine= $objCine->buscarId($idF);
                        $objCine->modificarPais_Cine($Cine,$cantP);
                    }

            }elseif ($opc== 3) {
               
                $objObra= new abmObraTeatro();
                echo "\n 1) cambiar nombre: ";
                echo "\n 2) cambiar precio: ";
                echo "\n 3) cambiar horario: ";
                echo "\n 4) cambiar duracion: ";
                
                $resp= trim(fgets(STDIN));

                    if ($resp== 1) {
                        
                        $objObra->mostrarObra();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n nombre nuevo: ";
                        $nom= trim(fgets(STDIN));
                        $Obra= $objObra->buscarId($idF);
                        $objObra->modificarNombre_Obra($Obra,$nom);

                    }elseif ($resp== 2) {
                        
                        $objObra->mostrarObra();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n  precio nuevo: ";
                        $precio= trim(fgets(STDIN));
                        $Obra= $objObra->buscarId($idF);
                        $objObra->modificarPrecio_Obra($Obra,$precio);
                    }elseif ($resp== 3) {
                        
                        $objObra->mostrarObra();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n horario nuevo: ";
                        $hora= trim(fgets(STDIN));
                        $Obra= $objObra->buscarId($idF);
                        $objObra->modificarHora_Obra($Obra,$hora);
                    }elseif ($resp== 4) {
                        
                        $objObra->mostrarObra();

                        echo "\n id de la funcion a cambiar: ";
                        $idF= trim(fgets(STDIN));
                        echo "\n duracion nueva: ";
                        $duracion= trim(fgets(STDIN));
                        $Obra= $objObra->buscarId($idF);
                        $objObra->modificarDuracion_Obra($Obra,$duracion);
                    }
            }
           
        break;

        case '7':


            echo "id de la funcion a eliminar: ";
            $idEliminar= trim(fgets(STDIN));

            $objMusical= new abmMusical;
            $objCine= new abmCine;
            $objObra=new abmObraTeatro; 
            
            $Cine=$objCine->buscarId($idEliminar);
            $Obra=$objObra->buscarId($idEliminar);
            $Musical=$objMusical->buscarId($idEliminar);

            if($idEliminar==$Musical->getIdFuncion()){
                
                $objMusical->eliminarMusical($Musical);
            }
            elseif ($idEliminar== $Cine->getIdFuncion()) {
                
                $objCine->eliminarCine($Cine);
            }elseif ($idEliminar== $Obra->getIdFuncion()) {
                
                $objObra->eliminarObra($Obra);
            }
            
          
            // $objCine->eliminarCine($Cine);
            




        break;
            

        case '8':


            $objTeatro= new abmTeatro();
            $teatro=$objTeatro->buscarId(1);
            $objTeatro->mostrarInfo_teatro($teatro);

        break;

        case '9':


           $objObra= new abmObraTeatro();
           $objMusical= new abmMusical();
           $objCine= new abmCine();

            echo  $objCine->darCosto();
            echo  $objMusical->darCosto();
            echo  $objObra->darCosto();

        break;
            
    
    }
} while ($eleccion < 10); 
?>