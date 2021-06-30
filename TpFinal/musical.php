<?php 

include 'funciones_Teatro.php';
class musical extends funciones_Teatro{

    private $director;
    private $cantidadPersonas;

    public function __construct()
    {
        parent:: __construct();

        $this->director="";
        $this->cantidadPersonas="";
    }


    public function cargar($array){	
        parent::cargar($array);
        $this->setdirector($array['director'])	;
		$this->setcantidadPersonas($array ['cantPersonas']);
    }



    // metodos de acceso del atributo $director

    public function getdirector(){
        return $this->director;
    }

    public function setdirector($director){
        return $this->director=$director;
    }


    // metodos de acceso del atributo $cantidadPersonas

    public function getcantidadPersonas(){
        return $this->cantidadPersonas;
    }

    public function setcantidadPersonas($cantidadPersonas){
        return $this->cantidadPersonas=$cantidadPersonas;
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
        return $stringPadre. "\n director: ".$this->getdirector(). "\n cantidad de persona en la escena: ". $this->getcantidadPersonas();
    }



    public function darCosto(){

        $costo = parent::darCostos_funciones();

        $costoFinal= $costo +($costo *0.12 );

        return $costoFinal;
    }



    public function Buscar($id){
		$base=new BaseDatos();
		$consulta="SELECT * FROM musical where idFuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){	
				    parent::Buscar($id);
				    $this->setdirector($row2['director']);
                    $this->setcantidadPersonas($row2['cantPersonas']);
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
		$consulta="SELECT * FROM musical INNER JOIN funciones_teatro ON musical.idFuncion= funciones_teatro.idFuncion ";
		if ($condicion!=""){
		    $consulta=$consulta.' WHERE '.$condicion;
		}
		$consulta.=" order by director ";
		 // echo $consulta;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){

					$obj=new musical();
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
		    $consultaInsertar="INSERT INTO musical(idFuncion, director, cantPersonas)
				VALUES (".parent::getIdFuncion().",'".$this->getdirector()."',".$this->getcantidadPersonas().")";

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
	        $consultaModifica="UPDATE musical SET director='".$this->getdirector()."',cantPersonas='".$this->getcantidadPersonas()."' WHERE idFuncion=". parent::getIdFuncion();
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
				$consultaBorra="DELETE FROM musical WHERE idFuncion=".parent::getIdFuncion();
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