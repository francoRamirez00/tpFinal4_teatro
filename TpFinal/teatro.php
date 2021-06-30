<?php
include_once "BaseDatos.php";
class Teatro{

    private $idTeatro;
    private $nombreTeatro ;
    private $direccionTeatro ;
    private $Funciones_Teatro ;



    public function __construct(){

        $this->idTeatro="";
        $this->nombreTeatro ="" ;
        $this->direccionTeatro ="";
        $this->Funciones_Teatro = [] ;
            
    }

    public function cargar($idTeatro,$nombreTeatro,$direccionTeatro,$Funciones_Teatro){

        $this-> setidTeatro($idTeatro);
        $this-> setNombreTeatro($nombreTeatro);
		$this-> setDireccionTeatro($direccionTeatro);
		$this-> setFunciones_teatro($Funciones_Teatro);
		
    }


    // metodos de acceso del atributo $idTeatro
    public function getidTeatro(){

        return $this->idTeatro;
    }
    public function setidTeatro($idTeatro){

        return $this->idTeatro=$idTeatro;
    }


    // metodos de acceso del atributo $nombreTeatro
    public function getNombreTeatro(){

        return $this->nombreTeatro ;
    }
    public function setNombreTeatro($nombreTeatro){

        return $this->nombreTeatro =$nombreTeatro;
    }


    // metodos de aaceso del atributo $direccionTeatro
    public function getDireccionTeatro(){

        return $this->direccionTeatro ;
    }
    
    public function setDireccionTeatro($direccionTeatro){

        return $this->direccionTeatro =$direccionTeatro ;
    }


    // metodos de aaceso del atributo $Funciones_Teatro
    public function getFunciones_teatro()
    {
       $condicion= "idTeatro= ".$this->getidTeatro();

        $objCine= new cine();
        $objObra= new obraTeatro();
        $objMusical= new musical();

        $objFuncion= new funciones_Teatro();
        

        // $colFunc= $objFuncion->listar($condicion);

        $col_cine= $objCine->listar($condicion);
        $col_obra= $objObra->listar($condicion);
        $col_musical= $objMusical->listar($condicion);

        $Funciones_Teatro= array_merge($col_cine,$col_musical,$col_obra);

        $this->setFunciones_teatro($Funciones_Teatro);
        return $Funciones_Teatro ;
    }
    
    public function setFunciones_teatro($Funciones_Teatro)
    {
        return $this->Funciones_Teatro = $Funciones_Teatro ;
    }


    // metodos de acceso del atributo $mensajeoperacion
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    
    public function setmensajeoperacion($mensajeoperacion){
		return $this->mensajeoperacion=$mensajeoperacion;
	}

    // public function creacionDeColeccion(){

    //     $colFunciones= $this->getFunciones_teatro();
    //     $condicion= "idTeatro= ".$this->getidTeatro();

    //     $objFuncion= new funciones_Teatro();
    //     $colFunciones= $objFuncion->listar($condicion);

    //     $objCine= new cine();
    //     $objObra= new obraTeatro();
    //     $objMusical= new musical();

    //     $col_cine= $objCine->listar($condicion);
    //     $col_obra= $objObra->listar($condicion);
    //     $col_musical= $objMusical->listar($condicion);

    //     array_push($colFunciones,$col_cine);
    //     array_push($colFunciones,$col_obra);
    //     array_push($colFunciones,$col_musical);

    //     $this->setFunciones_teatro($colFunciones);
    // }
    
    
    

    public function Buscar($id){
		$base= new BaseDatos();
		$consultaPersona="SELECT * FROM teatro WHERE idTeatro=".$id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setidTeatro($id);
					$this->setNombreTeatro($row2['nombre']);
					$this->setDireccionTeatro($row2['direccion']);
					// $this->setFunciones_teatro($row2['duracion']);
                    
                    
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	


    
	public  function listar($condicion=""){
	    $arregloTeatro = null;
		$base=new BaseDatos();
		$consultaPersonas="SELECT * FROM teatro ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' WHERE '.$condicion;
		}
		$consultaPersonas.=" order by idTeatro ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloTeatro= array();
				while($row2=$base->Registro()){
					
					$idTeatro=$row2['idTeatro'];
					$nombreTeatro=$row2['nombre'];
					$direccionTeatro=$row2['direccion'];
					// $Funciones_Teatro=$row2['FuncionesTeatro'];
				//------------------------------------------------- mirar las clases --------------------------------------------------------
					$newTeatro=new  Teatro();
                $newTeatro->cargar($idTeatro,$nombreTeatro,$direccionTeatro,[]);/*$Funciones_Teatro*/
					array_push($arregloTeatro,$newTeatro);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloTeatro;
	}	


    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO teatro(idTeatro, nombre, direccion) 
				VALUES (".$this->getidTeatro().",'".$this->getNombreTeatro()."','".$this->getDireccionTeatro()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}



    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE teatro SET nombre='".$this->getNombreTeatro()."',direccion='".$this->getDireccionTeatro()."' WHERE idTeatro=". $this->getidTeatro();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}


    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM teatro WHERE idTeatro=".$this->getidTeatro();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}


    // calcula el costo del alquiler del teatro con las funciones ya cargadas
    public function darCostoTeatro(){

        $coleccion= $this->getFunciones_teatro();
        $costoFinal = 0 ;
        foreach($coleccion as $tipoFuncion){

            $costo= $tipoFuncion->darCosto();
            $costoFinal += $costo;
        }

        return $costoFinal;
    }

    public function cargarFunciones($objFuncion){

        $coleccionFunciones= $this->getFunciones_teatro();
        $i=0;
        $existe= null;
        

        while ($i < count($coleccionFunciones) && is_null($existe)  ) {

            $nombreNuevo_Funcion= $objFuncion->getNombre();
            $existeHorario = $this->chequeoHorario($objFuncion-> getHora_inicio(),$objFuncion->getDuracion());

          if ( $nombreNuevo_Funcion !== $coleccionFunciones[$i]->getNombre() && $existeHorario) {
                
                array_push($colFunciones,$objFuncion);
                $this->setFunciones_teatro($colFunciones);   
                $existe= false;
          }

          $i++;
          $existe = null;

        }

        return $existe;
    }

   

    public function chequeoHorario($nuevahora, $nuevaDuracion){

        $terminaNuevo_horario = $nuevahora + $nuevaDuracion ;
        $i = 0 ;
        $retorno = false ;
        $Funcion = $this->getFunciones_teatro();
        do {
            

               //$horarioFuncion funcion que contiene el horario de finalizacion de las funciones
                $horarioFuncion =  $Funcion[$i]->getHora_inicio() +$Funcion[$i]->getDuracion();
                if (  $nuevahora < $Funcion[$i]->getHora_inicio() ||($terminaNuevo_horario < $horarioFuncion)  ) {
            
                    $retorno = true ;
                } else {
                   
                    $i++;
                }
           
        } while ($retorno == false && $i<count( $Funcion)) ;
       
        return $retorno ;
        

    }

    // funcion para cambiar el nombre al teatro
    public function cambiar_nom_teatro($nuevoNombre_Teatro){

        if ($nuevoNombre_Teatro !== $this-> getNombreTeatro() ) {
           
            $valido = true ;
            $this->setNombreTeatro($nuevoNombre_Teatro);
        }else {
            $valido = false ;
        }

        return $valido ;
    }

    // funcion para cambiar la direccion del teatro
    public function cambiar_nom_Direccion($nuevoNombre_Direccion){

        if ($nuevoNombre_Direccion !== $this-> getDireccionTeatro() ) {
           
            $valido = true ;
            $this->setDireccionTeatro($nuevoNombre_Direccion);
        }else {
            $valido = false ;
        }

        return $valido ;
    }

    // funcion para cambiar el nombre de la funcion
    public function cambiar_nom_Funcion($posicion,$nuevoNombre_funcion){
        
        $colFunciones=$this->getFunciones_teatro();
        if ($posicion >= 0 && $posicion <count($colFunciones)) {
            $existe = true ;
            $colFunciones[$posicion]->setNombre($nuevoNombre_funcion);
           
          
        }else {
            
           
            $existe = false ;
        }
        return $existe ;
               
    }

    


            // funcion para cambiar el precio de una funcion
       
    public function cambiar_precio_funcion($posicion, $precio){

        $colFunciones=$this->getFunciones_teatro();
        if ($posicion >= 0 && $posicion <count($colFunciones)) {
            $existe = true ;
            $colFunciones[$posicion]->setPrecio($precio);
           
          
        }else {
            
           
            $existe = false ;
        }
  

    

     return $existe ;
    
    }

    public function mostrarFunciones($col){

        foreach($col as $funcion){

            echo "\n ".$funcion ."\n-----------------------------------------";
        }
    }
    

    public function __toString()
    {
             
        
         $final ="id teatro: ".$this->getidTeatro()."\nnombre teatro : ". $this->getNombreTeatro()."\n". "direccion : ". $this->getDireccionTeatro()."\n". "--------- \n ".$this->mostrarFunciones($this->getFunciones_teatro());
        return $final; 

    
    }
}





// include 'funciones_Teatro.php' ; 
// $funciones = new funciones_Teatro("el leon", 21,1,150) ;

// $datos =new Teatro("san","calle", $funciones) ;

// MENU DEL TEATRO 
// echo "bienvenido al Teatro ". $datos->getNombreTeatro(). "\n" ;
// echo $datos->__construct("san","calle",$funciones);


// do {
//     echo "Por favor elija una opcion-------\n";
//     echo "      \n-1)ver informacion del teatro y las funciones actuales " ;
//     echo "      \n-2)cargar funcion nueva" ;
//     echo "      \n-3)cambiar nombre del teatro ";
//     echo "      \n-4)cambiar la direccion del teatro";
//     echo "      \n-5)cambiar nombre de una funcion";
//     echo "      \n-6)cambiar precio de una funcion";
//     echo "      \n-7) salir del menu " ;
//     $eleccion = trim(fgets(STDIN)) ;

//     switch ($eleccion) {

//         case '1':
               
//                 echo $datos  ;
//                 echo $datos->mostrarFunciones() . "\n";
//             break;
    
//         case '2':
//                 echo "cargar nueva funcion... \n nombre :" ;
//                 $newNombre = trim(fgets(STDIN)) ;

//                 echo "posicion :" ;
//                 $newPosicion = trim(fgets(STDIN)) ;

//                 echo "hora de inic:" ;
//                 $newHoraInicio = trim(fgets(STDIN)) ;

//                 echo "duracion :" ;
//                 $newDuracion = trim(fgets(STDIN)) ;

//                 echo "precio :" ;
//                 $newPrecio = trim(fgets(STDIN)) ;

//                $newFuncion = new funciones_Teatro($newNombre,$newHoraInicio,$newDuracion,$newPrecio) ;
//                     $datos->cargarFunciones($newPosicion,$newFuncion) ;
//                    /* $datos =new Teatro("san","calle", $newFuncion) ;*/
//                     echo $datos;
//                 if ($datos->cargarFunciones($newPosicion,$newFuncion) == true) {

//                     echo "funcion nueva cargada exitosamente " ;
                    
                    
//                 }else {
//                     echo "fallo" ;
//                 }

               

//             break;

//         case '3':

//                 echo "ingrese nuevo nombre de teatro : "  ;
//                 $nuevoNombre_Teatro = trim(fgets(STDIN)) ;
//                 echo "Cargando nombre del teatro .   .   .  . ". "\n" ;
//                 $validez = $datos->cambiar_nom_teatro($nuevoNombre_Teatro) ;
//                     if ($validez == true) {
//                          echo "El nombre del teatro fue cambiado exitosamente". "\n" ;
//                     }else {
//                          echo "el nombre que se ingreso ya existia ". "\n" ;
//                     }   
//                          echo "saliendo al menu . . .". "\n" ;

//             break;
    
//         case '4':

//                 echo "ingrese nueva direccion : " ;
//                 $nuevoNombre_Direccion = trim(fgets(STDIN)) ;
//                  echo "Cargando direccion del teatro .   .   .  . ". "\n" ;
//                 $validez = $datos->cambiar_nom_Direccion($nuevoNombre_Direccion);
//                 if ($validez == true) {
//                         echo "La direccion del teatro fue cambiada exitosamente". "\n" ;
    
//                 }else {
//                         echo "el nombre ingresado ya se encuentra" ."\n" ;
//                         echo "saliendo al menu . . .". "\n" ;
//                 }
       
//             break ;

//         case '5':

//             echo "ingrese nombre de la nueva funcion: " ;
//             $nombreNuevo_Funcion = trim(fgets(STDIN)) ;
//             echo "ingrese que numero de la funcion desea cambiar (0 - 3): " ;
//             $posicion = trim(fgets(STDIN));
//             echo "cargando nombre a la nueva funcion . . . .". "\n" ;
//             $validez = $datos->cambiar_nom_Funcion($posicion,$nombreNuevo_Funcion) ;

//                 if ($validez) {
//                         echo "El nombre de la funcion ". $posicion. " fue actualizado correctamente" ."\n";
//                 }else {
//                         echo "El numero de la posicion ingresado es incorrecto " . "\n";
// }
//                         echo "saliendo al menu . . ." . "\n";

//         break;
            
//         case '6':

//             echo "ingrese el numero de la funcion desea cambiar el precio (0 - 3): " ;
//             $posicion = trim(fgets(STDIN));
//             echo "ingrese el precio que desea cargar: ". "\n" ;
//             $precioNuevo = trim(fgets(STDIN)) ;
//             echo "cargando precio en la posicion " . $posicion. "\n" ;
//             $validez = $datos->cambiar_precio_Funcion($posicion,$precioNuevo) ;

//                 if ($validez) {
//                     echo "El precio fue actualizado exitosamente ". "\n" ;
//                 }else {
//                     echo "numero de la posicion ingresado incorrecto" ;
// }           
//                     echo "saliendo al menu . . ." . "\n";
    
//         break;
            
    
//     }
// } while ($eleccion < 7); 
    
    














 

 


  