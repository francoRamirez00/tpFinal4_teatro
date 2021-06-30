<?php
include_once 'BaseDatos.php';
// include 'funciones_Teatro.php';
class obraTeatro extends funciones_Teatro{

    public function __construct()
    {
        parent:: __construct();
    }


    public function cargar($array){	
        parent::cargar($array);
        
    }

   

    public function __toString()
    {
        $stringObra= parent::__toString();
        return $stringObra ."\n";
    }

    public function darCosto(){

        $costo = parent::darCostos_funciones();

        $costoFinal= $costo +($costo *0.45 );

        return $costoFinal;
    }


    public function Buscar($id){
		$base=new BaseDatos();
		$consulta="SELECT * FROM obrateatro where idFuncion=".$id;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){
				if($base->Registro()){	
				    parent::Buscar($id);
				   
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
		$consulta="SELECT * FROM obrateatro INNER JOIN funciones_teatro ON obrateatro.idFuncion= funciones_teatro.idFuncion ";
		if ($condicion!=""){
		    $consulta=$consulta.' WHERE '.$condicion;
		}
		// $consulta.=" order by idFuncion ";
		// echo $consulta;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new obraTeatro();
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
		    $consultaInsertar="INSERT INTO obrateatro(idFuncion)
				VALUES (".parent::getIdFuncion().")";
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
	        $consultaModifica="UPDATE obrateatro  WHERE idFuncion=". parent::getIdFuncion();
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
				$consultaBorra="DELETE FROM obrateatro WHERE idFuncion=".parent::getIdFuncion();
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