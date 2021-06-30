<?php

// include 'funcion.php';
class cine extends funciones_Teatro{

    private $genero ;
    private $paisOrigen;

    // metodo constructor

    public function __construct()
    {
        parent:: __construct();
    
        $this->genero="";
        $this->paisOrigen="";
    }


    public function cargar($array){	
        parent::cargar($array);
        $this->setGenero($array['genero'])	;
		$this->setpaisOrigen($array ['paisOrigen']);
    }


    // metodos de acceso del atributo $genero

    public function getGenero(){
        return $this->genero;
    }

    public function setGenero($genero){
        return $this->genero=$genero;
    }


    // metodos de acceso del atributo $paisOrigen

    public function getpaisOrigen(){
        return $this->paisOrigen;
    }

    public function setpaisOrigen($paisOrigen){
        return $this->paisOrigen=$paisOrigen;
    }


    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    public function setmensajeoperacion($mensajeoperacion){
		return $this->mensajeoperacion=$mensajeoperacion;
	}


    public function __toString()
    {
        $stringPadre= parent::__toString();
        return $stringPadre. "\n genero: ".$this->getGenero(). "\n pais de origen: ".$this->getpaisOrigen();
    }



    public function darCosto(){

        $costo = parent::darCostos_funciones();

        $costoFinal= $costo +($costo *0.65 );

        return $costoFinal;
    }


    public function Buscar($id){
		$base=new BaseDatos();
		$consulta="SELECT * FROM cine where idFuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($id);
				    $this->setpaisOrigen($row2['paisOrigen']);
                    $this->setGenero($row2['genero']);
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
	    $arreglo = null;
		$base=new BaseDatos();
		// $consulta= "SELECT * FROM cine" ;
		$consulta='SELECT * FROM cine INNER JOIN funciones_teatro ON cine.idFuncion= funciones_teatro.idFuncion';
		if ($condicion!=""){
		    $consulta=$consulta.' WHERE '.$condicion;
		}
		$consulta.=" order by genero ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new cine();
					$obj->Buscar($row2['idFuncion']);
					array_push($arreglo,$obj);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}	


    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		
		if(parent::insertar()){
		    $consultaInsertar="INSERT INTO cine(idFuncion, genero, paisOrigen)
				VALUES (".parent::getIdFuncion().",'".$this->getGenero()."','".$this->getpaisOrigen()."')";
				// echo $consultaInsertar;
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp=  true;
		        }	else {
		            $this->setmensajeoperacion($base->getError());
		        }
		    } else {
		        $this->setmensajeoperacion($base->getError());
		    }
		 }
		return $resp;
	}


    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica="UPDATE cine SET paisOrigen ='".$this->getpaisOrigen()."',genero='".$this->getGenero()."' WHERE idFuncion=". parent::getIdFuncion();
	        echo $consultaModifica;
			if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp=  true;
	            }else{
	                $this->setmensajeoperacion($base->getError());
	                
	            }
	        }else{
	            $this->setmensajeoperacion($base->getError());
	            
	        }
	    }
		
		return $resp;
	}


    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM cine WHERE idFuncion=".parent::getIdFuncion();
				if($base->Ejecutar($consultaBorra)){
				    if(parent::eliminar()){
				        $resp=  true;
				    }
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

}
?>